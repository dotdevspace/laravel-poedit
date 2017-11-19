<?php
    
    Route::get('/', [
        'as'   => 'dotdevspace.poedit.index',
        'uses' => 'Controller@getIndex',
    ]);