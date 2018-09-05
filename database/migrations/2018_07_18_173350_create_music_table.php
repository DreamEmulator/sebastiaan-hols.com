<?php

	use Illuminate\Support\Facades\Schema;
	use Illuminate\Database\Schema\Blueprint;
	use Illuminate\Database\Migrations\Migration;

	class CreateMusicTable extends Migration
	{
		/**
		 * Run the migrations.
		 *
		 * @return void
		 */
		public function up()
		{
			Schema::create('music', function (Blueprint $table)
			{
				$table->increments('id');
				$table->timestamps();
				$table->string('img_location')->nullable();
				$table->string('title')->nullable();
				$table->string('text')->nullable();
				$table->string('spotify')->nullable();
				$table->string('tidal')->nullable();
				$table->string('muziekweb')->nullable();
			});
		}

		/**
		 * Reverse the migrations.
		 *
		 * @return void
		 */
		public function down()
		{
			Schema::dropIfExists('music');
		}
	}
