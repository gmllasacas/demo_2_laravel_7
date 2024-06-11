<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepartmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('departments', function (Blueprint $table) {
            $table->id();
            $table->string('name', 45)->unique();
            $table->bigInteger('superior_id')->nullable()->unsigned();
            $table->bigInteger('parent_id')->nullable()->unsigned();
            $table->bigInteger('embassador_id')->nullable()->unsigned();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('superior_id')->nullable()->references('id')->on('departments')->cascadeOnUpdate()->nullOnDelete();
            $table->foreign('parent_id')->nullable()->references('id')->on('departments')->cascadeOnUpdate()->nullOnDelete();
            $table->foreign('embassador_id')->nullable()->references('id')->on('embassadors')->cascadeOnUpdate()->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('departments', function (Blueprint $table) {
            $table->dropForeign('departments_parent_id_foreign');
            $table->dropForeign('departments_superior_id_foreign');
            $table->dropForeign('departments_embassador_id_foreign');
        });

        Schema::dropIfExists('departments');
    }
}
