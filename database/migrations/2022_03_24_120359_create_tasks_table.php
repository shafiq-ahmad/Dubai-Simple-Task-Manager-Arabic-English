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
	//fields: id, project_id, company_id, title, desc, due_date, created_at, completed_at, status [pending, approved, refuced]
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('project_id');
            $table->string('title');
            $table->string('status');
            $table->string('user')->default('');
            $table->longText('desc');
            $table->date('due_date');
            $table->date('completed_at')->nullable()->default(NULL);
            $table->timestamps();
			$table->foreign('project_id')->references('id')->on('projects');
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
        Schema::dropIfExists('tasks');
    }
};
