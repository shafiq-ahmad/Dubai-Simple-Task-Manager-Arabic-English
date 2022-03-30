<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
	 //fields: id, task [text/number], desc, deadline, company [text], status
    public function up()
    {
        Schema::create('archives', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('task');
            $table->string('company');
            $table->string('project');
            $table->string('status');
            $table->string('user');
            $table->longText('desc');
            $table->dateTime('deadline');
            $table->timestamps();
			$table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('archives');
    }
};
