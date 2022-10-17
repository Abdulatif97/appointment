<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateIdentifiersTable.
 */
class CreateIdentifiersTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('identifiers', function(Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('use');
			$table->string('type');
			$table->string('system');
			$table->string('value')->unique();
			$table->timestamp('start_date')->nullable();
			$table->timestamp('end_date')->nullable();
			$table->string('assigner')->nullable();
            $table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('identifiers');
	}
}
