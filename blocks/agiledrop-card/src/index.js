registerBlockType( 'agiledrop/agiledrop-card', {
	title: 'Agiledrop Card',
	icon: 'index-card',
	category: 'layout',
	attributes: {
		postTypes: {
			default: [
				{ value: 'agiledrop-jobs', label: 'agiledrop-jobs' },
				{ value: 'agiledrop-employees', label: 'agiledrop-employees' },
			]
		},
		selectedPostType:{
			default: 'agiledrop-jobs',
		},
		runGetPosts: {
			default: true,
		},
		selectPost:[{}],
		selectedPost: {},
		title: {
			type: 'array',
			source: 'children',
			selector: 'h2',
		},
		description: {
			type: 'array',
			source: 'children',
			selector: 'p',
		},
		image:{
			type: 'string',
			source: 'attribute',
			selector: 'img',
			attribute: 'src',
		}

	},
	edit: ( props ) => {
		const {
			attributes:{
				postTypes,
				selectedPostType,
				runGetPosts,
				selectPost,
				selectedPost,
				title,
				description,
				image
			},

			setAttributes,
		} = props;
		let posts = [];

		const onChangePostType = ( value ) => {
			setAttributes( { runGetPosts: true, selectedPostType: value } );
		};

		const getPosts = () => {
			if ( runGetPosts ) {
				let allPosts = [];
				let select = [];

				apiFetch( { path: '/agiledrop/v1/' + selectedPostType } ).then( posts => {
					if ( posts.length != 0 ) {
						for ( let i in posts ) {
							let post;
							let oneSelect
							if ( posts.hasOwnProperty( i ) ) {
								post = {id: i, title: posts[i].title, content: posts[i].text, img: posts[i].image };
								oneSelect = { value: posts[i].title, label: posts[i].title }
							}
							allPosts.push( post );
							select.push( oneSelect );
						}
						setAttributes( { selectPost: select, selectedPost: select[0].value } );
					}

				} );
				this.posts = allPosts;
				setAttributes( { runGetPosts: false } );
			}
		};
		getPosts();

		const onChangePosts = ( value ) => {
			setAttributes( { selectedPost: value } )
		}

		const savePost = ( ) => {
			if ( this.posts ) {
				for ( let i = 0; i < this.posts.length; i++ ) {
					if ( this.posts[i].title === selectedPost ) {
						setAttributes( { title: this.posts[i].title, description: this.posts[i].content, image: this.posts[i].img } );
					}
				}
			}
		}
		savePost();

		return (
			<div className="agiledrop-card">
				<InspectorControls>
					<RadioControl
						label="Select Post Type"
						selected={ selectedPostType }
						options={ postTypes }
						onChange={ onChangePostType }
					/>
					<RadioControl
						label="Select Post"
						selected={ selectedPost }
						options={ selectPost }
						onChange={ onChangePosts }
					/>
				</InspectorControls>
				<img src={ image }/>
				<RichText.Content tagName="h2" value={ title } />
				<RichText.Content tagName="p" value={ description } />

			</div>
		);
	},
	save: ( props ) => {
		const {
			attributes: {
				title,
				description,
				image
			},
		} = props;

		return (
			<div className="agiledrop-card">
				<img src={ image }/>
				<div className="agiledrop-card__content">
				<RichText.Content tagName="h3" value={ title } />
				<RichText.Content tagName="p" value={ description } />
				</div>

			</div>
		);
	},
} );
