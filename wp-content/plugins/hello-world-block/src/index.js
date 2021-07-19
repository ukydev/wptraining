

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
			selectedCategory: {
				type: 'string'
			},
			postsPerPage: {
				type: 'string'
			}
		},
		edit: function ( props ) {

			if(!props.attributes.categories) {
				wp.apiFetch({
					url:'/wp-json/wp/v2/categories'
				}).then( categories => {
					props.setAttributes({
						categories: categories
					})
				});
			}

			if(!props.attributes.categories) {
				return 'Loading...';
			}

			if(props.attributes.categories && props.attributes.categories.length === 0) {
				return 'No categories found';
			}

			console.log(props.attributes)

			function updateCategory(e) {
				props.setAttributes({
					selectedCategory: e.target.value
				});
			}

			function updatePostsPerPage(e) {
				props.setAttributes({
					postPerPage: e.target.value
				});
			}

			return (
				<div>
					<label>Category</label>
					<select onChange={updateCategory} value={props.attributes.selectedCategory}>
						{
							props.attributes.categories.map( category => {
								return (
									<option value={ category.id } key={ category.id } >
										{ category.name }
									</option>
								);
							})
						}
					</select>
                    <label>Posts Per Page</label>
					<input type ="text" onBlur={updatePostsPerPage} value={props.attributes.postsPerPage}/>
				</div>
			);
		},
		save: () => null
	}
);
