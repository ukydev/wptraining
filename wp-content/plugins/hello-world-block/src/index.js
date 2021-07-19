

const { registerBlockType } = wp.blocks;

registerBlockType(
	'tenup-exercises/hello-world',
	{
		title: 'Hello World',
		category: 'common',
		icon: 'smiley',
		attributes: {
			categories: {
				type: 'object'
			},
			selectedBook: {
				type: 'string'
			},
			postsPerPage: {
				type: 'string'
			},
			books: {
				type:'object'
			}
		},
		edit: function ( props ) {
			if(!props.attributes.books) {
				wp.apiFetch({
					url:'/wp-json/library/book'
				}).then( books => {
					props.setAttributes({
						books: books
					})
				});
			}

			if(!props.attributes.books) {
				return 'Loading...';
			}

			if(props.attributes.books && props.attributes.books.length === 0) {
				return 'No books found';
			}

			console.log(props.attributes)

			function updateBooks(e) {
				props.setAttributes({
					selectedBook: e.target.value
				});
			}

			console.log(props.attributes.selectedBook);
			return (
				<div>
					<label>Books</label>
					<select onChange={updateBooks} value={props.attributes.selectedBook}>
						{
							props.attributes.books.map( books => {
								return (
									<option value={ books.id } key={ books.id } >
										{ books.post_title }
									</option>
								);
							})
						}
					</select>
				</div>
			);
		},
		save: () => null
	}
);
