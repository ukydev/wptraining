<div class="book_box">
    <style scoped>
        .book_box{
            display: grid;
            grid-template-columns: max-content 1fr;
            grid-row-gap: 10px;
            grid-column-gap: 20px;
        }
        .book_field{
            display: contents;
        }
    </style>
    <p class="meta-options book_field">
        <label for="book_author">Author</label>
        <input id="book_author"
               type="text"
               name="book_author"
               value="<?php echo esc_attr( get_post_meta( get_the_ID(), 'book_author', true ) ); ?>">
    </p>
    <p class="meta-options book_field">
        <label for="book_published_date">Published Date</label>
        <input id="book_published_date"
               type="date"
               name="book_published_date"
               value="<?php echo esc_attr( get_post_meta( get_the_ID(), 'book_published_date', true ) ); ?>">
    </p>
    <p class="meta-options book_field">
        <label for="book_price">Price</label>
        <input id="book_price"
               type="number"
               name="book_price"
               value="<?php echo esc_attr( get_post_meta( get_the_ID(), 'book_price', true ) ); ?>">
    </p>
</div>