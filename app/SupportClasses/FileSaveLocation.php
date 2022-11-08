<?php

namespace App\SupportClasses;

use App\Models\Homework;
use App\Models\Subject;
use Illuminate\Support\Str;
use phpDocumentor\Reflection\DocBlock\Tags\Author;

class FileSaveLocation
{
    /**
     * use it to save into \public
     */
     const PUBLIC = 1;

    /**
     * Saves into \storage\app
     */
     const INTERNAL_STORAGE = 2;

    /**
     * Save into \storage\app\public
     */
     const INTERNAL_STORAGE_PUBLIC = 3;

    /**
     * Returns e.g. homework/teacher/dimitriou/mathimatika/ergastiriaki/
     */
    public static function getHomeworkFileSaveLocation(Subject $subject, Homework $homework)
    {
//        EXAMPLES
//        $org_path = Str::slug($institute->getOrganisation()->acronym);
//        $eval_path = Str::slug($evaluationPeriod->getSpan());
//        $institute_path = Str::slug($institute->acronym);
        // $saveRelativePath =

        $role_path = Str::slug(auth()->user()->role);
        $user_path = Str::slug(auth()->user()->surname);
        $subj_path = Str::slug($subject->name);
        $type_path = Str::slug($homework->filetype);

        return 'homework' . DIRECTORY_SEPARATOR . $role_path . DIRECTORY_SEPARATOR . $user_path . DIRECTORY_SEPARATOR . $subj_path . DIRECTORY_SEPARATOR. $type_path;
    }

//    /**
//     * Returns e.g. evaluations/2018-2021/ncsr-d/iit/committee_file/institute
//     */
//    public static function getInstituteCommitteeFileSaveLocation(Institute $institute, EvaluationPeriod $evaluationPeriod)
//    {
//        return self::getHomeworkFileSaveLocation($institute, $evaluationPeriod) . DIRECTORY_SEPARATOR . 'committee_file' . DIRECTORY_SEPARATOR . 'institute';
////        $org_path = Str::slug($institute->getOrganisation()->acronym);
////        $eval_path = Str::slug($evaluationPeriod->getSpan());
////        $institute_path = Str::slug($institute->acronym);
////        // $saveRelativePath =
////        return 'evaluations' . DIRECTORY_SEPARATOR . $eval_path . DIRECTORY_SEPARATOR
////            . $org_path . DIRECTORY_SEPARATOR . $institute_path . DIRECTORY_SEPARATOR . 'committee_file' . DIRECTORY_SEPARATOR . 'institute';
//    }
//
//
//    /**
//     * Returns e.g. evaluations/2018-2021/ncsr-d/iit/committee_file/group_name
//     */
//    public static function getGroupFileSaveLocation(ResearchGroup $group, EvaluationPeriod $evaluationPeriod)
//    {
//        $institute = $group->institute;
//        $org_path = Str::slug($institute->getOrganisation()->acronym);
//        $eval_path = Str::slug($evaluationPeriod->getSpan());
//        $institute_path = Str::slug($institute->acronym);
//        $group_path = Str::slug($group->acronym);
//
//        return 'evaluations' . DIRECTORY_SEPARATOR . $eval_path . DIRECTORY_SEPARATOR
//            . $org_path . DIRECTORY_SEPARATOR . $institute_path . DIRECTORY_SEPARATOR . 'committee_file' . DIRECTORY_SEPARATOR . $group_path;
//    }
//
//    /**
//     * Returns the path to the Guides Files end with slash, so simply grab this and add your filename at the end.
//     */
//    public static function getGuidesFilesLocation()
//    {
//        return storage_path() . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'templates' . DIRECTORY_SEPARATOR . 'guide' . DIRECTORY_SEPARATOR;
//    }

}
