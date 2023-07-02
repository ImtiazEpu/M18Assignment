<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create( 'posts', function ( Blueprint $table ) {
            $table->id();
            $table->string( 'title', 100 );
            $table->text( 'content' );
            $table->unsignedBigInteger( 'category_id' );

            /**
             * Relationship
             */
            $table->foreign( 'category_id' )
                  ->references( 'id' )
                  ->on( 'categories' )
                  ->restrictOnDelete()
                  ->cascadeOnUpdate();

            $table->timestamp( 'created_at' )->useCurrent();
            $table->timestamp( 'updated_at' )->useCurrent()->useCurrentOnUpdate();
            $table->softDeletes();
        } );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists( 'posts' );
    }
};
