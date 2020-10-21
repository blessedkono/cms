<?php

namespace App\Repositories\System;


use App\Models\System\Document;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

class JobManageRepository extends BaseRepository
{


    /**
     * @return \Illuminate\Database\Query\Builder
     * -==================START-JOBS METHODS-===================
     */

    /*Get active Jobs for Datatable*/
    public function getActiveJobsForDt()
    {
        $jobs = DB::table('jobs');
        return $jobs;
    }




    /*Delete job*/
    public function deleteJob($job_id)
    {
        DB::table('jobs')->where('id', $job_id)->delete();
    }


    /*Delete All jobs*/
    public function deleteAllJobs()
    {
        DB::table('jobs')->delete();
    }


    /*Get Date from Integer*/
    public function getDateFromInt($timestamp)
    {
        return idate('j', $timestamp) . '-' . idate('m', $timestamp) . '-' . idate('Y', $timestamp) . ' ' . idate('H', $timestamp) . ':' . idate('i', $timestamp) . ':' . idate('s', $timestamp);
    }


    /*Count Jobs*/
    public function countJobs()
    {
        return $this->getActiveJobsForDt()->count();
    }

    /*---------End of JOBS Methods----------*/


    /**
     * @param $failed_job_id
     * ==================Start - FAILED JOBS METHODS ============================
     */


    /*Delete failed job*/
    public function deleteFailedJob($failed_job_id)
    {
        DB::table('failed_jobs')->where('id', $failed_job_id)->delete();
    }


    /*Delete All Failed jobs*/
    public function deleteAllFailedJobs()
    {
        DB::table('failed_jobs')->delete();
    }

    /*Get failed jobs for datatable*/
    public function getFailedJobsForDt()
    {
        $failed_jobs = DB::table('failed_jobs');
        return $failed_jobs;
    }

    /*Count Failed Jobs*/
    public function countFailedJobs()
    {
        return $this->getFailedJobsForDt()->count();
    }


    /*-------End --- Failed Jobs Methods----------------------*/







}