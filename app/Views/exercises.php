<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<div class="container text-center mt-5">
    <h2 class="mb-4">Exercice de respiration</h2>

    <div class="mb-4">
        <label for="modeSelect" class="form-label">Choisissez un rythme :</label>
        <select id="modeSelect" class="form-select w-auto mx-auto">
            <option value="748">7-4-8 (Inspiration, Apnée, Expiration)</option>
            <option value="55">5-5 (Inspiration, Expiration)</option>
            <option value="46">4-6 (Inspiration, Expiration)</option>
        </select>
    </div>

    <div class="breathing-container">
        <div class="circle-container" id="circle-container">
            <svg width="220" height="220">
                <circle class="bg" cx="110" cy="110" r="100" />
                <circle class="progress" cx="110" cy="110" r="100" />
            </svg>
            <div class="breath-text" id="phase-text">Clique pour démarrer</div>
        </div>
    </div>

    <!-- Sons -->
    <audio id="sound-inspire" src="<?= base_url('sounds/inspiration.mp3') ?>"></audio>
    <audio id="sound-apnea" src="<?= base_url('sounds/apnea.mp3') ?>"></audio>
    <audio id="sound-expire" src="<?= base_url('sounds/expiration.mp3') ?>"></audio>
</div>

<style>
    .breathing-container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 60vh;
    }

    .circle-container {
        position: relative;
        width: 220px;
        height: 220px;
        cursor: pointer;
    }

    svg {
        transform: rotate(-90deg);
    }

    circle {
        fill: none;
        stroke-width: 12;
        stroke-linecap: round;
    }

    .bg {
        stroke: #e6e6e6;
    }

    .progress {
        stroke: #2BA84A;
        stroke-dasharray: 628;
        stroke-dashoffset: 628;
        transition: stroke-dashoffset linear;
    }

    .breath-text {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        font-size: 1.3rem;
        font-weight: bold;
        color: #2BA84A;
        text-align: center;
    }

    #modeSelect {
        border-color: #2BA84A;
    }
</style>

<script>
    let startTime;
    const phaseText = document.getElementById('phase-text');
    const modeSelect = document.getElementById('modeSelect');
    const progressCircle = document.querySelector('.progress');
    const CIRCUMFERENCE = 2 * Math.PI * 100;
    progressCircle.style.strokeDasharray = CIRCUMFERENCE;

    const sounds = {
        in: document.getElementById('sound-inspire'),
        hold: document.getElementById('sound-apnea'),
        out: document.getElementById('sound-expire')
    };

    const durations = {
        '748': {
            in: 7000,
            hold: 4000,
            out: 8000
        },
        '55': {
            in: 5000,
            hold: 0,
            out: 5000
        },
        '46': {
            in: 4000,
            hold: 0,
            out: 6000
        }
    };

    let isRunning = false;
    let mode = modeSelect.value;
    let currentTimeout = null;

    function playSound(sound) {
        sound.pause();
        sound.currentTime = 0;
        sound.play().catch(() => {});
    }

    function updateProgress(duration) {
        progressCircle.style.transitionDuration = duration + "ms";
        progressCircle.style.strokeDashoffset = 0;
    }

    function resetProgress() {
        progressCircle.style.transitionDuration = "0ms";
        progressCircle.style.strokeDashoffset = CIRCUMFERENCE;
    }

    function phase(label, duration, soundKey, callback) {
        if (!isRunning) return;
        resetProgress();
        setTimeout(() => updateProgress(duration), 50); // léger délai pour permettre transition
        phaseText.innerText = label;
        if (soundKey) playSound(sounds[soundKey]);

        currentTimeout = setTimeout(callback, duration);
    }

    function startCycle() {
        if (!isRunning) return;

        const d = durations[mode];

        phase("Inspiration", d.in, 'in', () => {
            if (d.hold > 0) {
                phase("Apnée", d.hold, 'hold', () => {
                    phase("Expiration", d.out, 'out', startCycle);
                });
            } else {
                phase("Expiration", d.out, 'out', startCycle);
            }
        });
    }

    document.getElementById('circle-container').addEventListener("click", () => {
    isRunning = !isRunning;

    if (isRunning) {
        mode = modeSelect.value;
        startTime = Date.now(); // On démarre le chrono
        resetProgress();
        startCycle();
    } else {
        clearTimeout(currentTimeout);
        resetProgress();
        phaseText.innerText = "Clique pour démarrer";

        const duree = Math.floor((Date.now() - startTime) / 1000);

        if (duree >= 10) {
            const typeMap = {
                '748': '7-4-8',
                '55': '5-5',
                '46': '4-6'
            };

            fetch("<?= base_url('exercises/terminer') ?>", {
                method: "POST",
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded"
                },
                body: `duree=${duree}&type=${encodeURIComponent(typeMap[mode])}`
            }).then(res => res.json())
              .then(data => {
                  if (data.success) {
                      console.log("✅ Exercice enregistré !");
                  } else {
                      console.error("❌ Erreur : ", data.message);
                  }
              });
        }
    }
});

</script>

<?= $this->endSection() ?>