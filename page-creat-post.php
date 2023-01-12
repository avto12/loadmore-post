<?php

get_header();

?>

    <section class="container">
        <div class="post-all">
           <h2> Add To Post </h2>


                <input type="text"  class="form-control" name="title" placeholder="Title" >
                <textarea name="content" placeholder="Enter Content Text" class="form-control" cols="30" rows="10"></textarea>

                <button id="add_posts_btn" class="btn btn-info text-dark"> Create Post </button>

        </div>

    </section>

<?php get_footer(); ?>