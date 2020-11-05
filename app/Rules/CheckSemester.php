<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Semester;
use Auth;

class CheckSemester implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $user= Auth::user();
        $semester= Semester::findOrFail($value);
        $batches= $semester->batches;

        if (count($batches)<1) {
            return false;
        }

        $match_dep=1;
        foreach ($user->departments as $dep) {
            foreach ($batches as $batch) {
                foreach ($batch->department as $depar) {
                    if ($depar->id == $dep->id) {
                        $match_dep=2;
                    }
                }
            }
        } 
        if ($match_dep==1) {
            return false;
        }

        foreach ($user->subjects as $subject) {
          foreach ($subject->semesters as $u_semester) {
            if ($u_semester->id == $semester->id) {
              return true;
            }
          }
        }
        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'You are not assigned to any subjects of this semester or this semester has no batch assigned.';
    }
}
