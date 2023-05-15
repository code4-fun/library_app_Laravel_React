<?php

namespace App\Jobs;

use App\Imports\CategoryImport;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Maatwebsite\Excel\Facades\Excel;

class CategoriesImportJob implements ShouldQueue{
  use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, Batchable;
  private $url;

  /**
   * Create a new job instance.
   */
  public function __construct($url){
    $this->url = $url;
  }

  /**
   * Execute the job.
   */
  public function handle():void{
    Excel::import(new CategoryImport, public_path($this->url));
  }
}