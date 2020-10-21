<?php

Route::group([
    'middleware' => ['web','auth'],
    'namespace' => 'System',
], function() {


    Route::group([ 'prefix' => 'workflow',  'as' => 'workflow.'], function() {



        Route::get('index', 'WorkflowController@index')->name('index');
        Route::get('allocation', 'WorkflowController@allocation')->name('allocation');
        Route::put('assign_allocation', 'WorkflowController@assignAllocation')->name('assign_allocation');
        Route::get('pending/get', 'WorkflowController@getPending')->name('pending.get');
        Route::get('workflow_defaults', 'WorkflowController@workflowDefaults')->name('workflow_defaults');
        Route::put('assign_wf_defaults', 'WorkflowController@assignWfDefaults')->name('assign_wf_defaults');
        Route::get('get_users/{definition}', 'WorkflowController@getUsers')->name('get_users');
        Route::get('update_definition_users/{definition}', 'WorkflowController@updateDefinitionUsers')->name('update_definition_users');
        Route::get('workflow_content/', 'WorkflowController@getWorkflowTrackContent')->name('workflow_content');
        Route::post('update_workflow/{wf_track}', 'WorkflowController@updateWorkflow')->name('update_workflow');
        /*Workflow for sidebar*/
        Route::get('pending', 'WorkflowController@pending')->name('pending');
        Route::get('pending/get', 'WorkflowController@getPending')->name('pending.get');
    });

});



