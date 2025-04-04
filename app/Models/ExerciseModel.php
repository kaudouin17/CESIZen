<?php

namespace App\Models;

use CodeIgniter\Model;

class ExerciseModel extends Model
{
    protected $table = 'exercice_sessions';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'duree_seconds', 'date_session', 'type_exercice'];
    protected $useTimestamps = true;
}

