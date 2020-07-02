registerBlockType( 'agiledrop/agiledrop-card', {
	title: 'Agiledrop Card',
	icon: 'index-card',
	category: 'layout',
	attributes: {
		runGetPostTypes:{
			default: true,
		},
		postTypes:[],
		selectedPostType:{
			default: 'agiledrop-jobs',
		},
		runGetPosts: {
			default: true,
		},
		selectPost:[],
		selectedPost: {},
		title: {
			type: 'array',
			source: 'children',
			selector: 'h2',
		},
		content:{}

	},
	edit: ( props ) => {
		const {
			attributes:{
				runGetPostTypes,
				postTypes,
				selectedPostType,
				runGetPosts,
				selectPost,
				selectedPost,
				title,
				content,
			},

			setAttributes,
		} = props;
		let posts = [];

		const getAllPostTypes = () => {
			if ( runGetPostTypes ) {
				apiFetch({path:'/agiledrop/v1/custom-post-types'}).then( postTypes => {
					let allPostTypes = postTypes.map( postType => {
						return { value: postType, label: postType }
					})
					setAttributes({postTypes: allPostTypes});
				})
				setAttributes({runGetPostTypes:false});
			}
		}
		getAllPostTypes();

		const onChangePostType = ( value ) => {
			setAttributes( { runGetPosts: true, selectedPostType: value } );
		};

		const getPosts = () => {
			if ( runGetPosts ) {
				apiFetch( { path: '/agiledrop/v1/' + selectedPostType } )
					.then( posts => {
						let allPosts = posts.map( obj => {
							if ( obj.post_title ) {
								return {id:obj.ID, title:obj.post_title, content: obj.post_content}
							}
						});
						let selectPosts = posts.map( obj => {
							return { value:obj.ID, label:obj.post_title}
						})
						this.posts = allPosts;
						setAttributes( { selectPost: selectPosts } );
					} );
				setAttributes( { runGetPosts: false } );
			}
		};
		getPosts();

		const onChangePosts = ( value ) => {
			setAttributes( { selectedPost: parseInt(value) } )
		}

		const savePost = () => {
			if ( this.posts ) {
				this.posts.map( post => {
					if ( post.id === selectedPost) {
						setAttributes({title:post.title, content: post.content})
					}
				})
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
				<RichText.Content tagName="h2" value={ title } />
				<div class="agiledrop-card__content" dangerouslySetInnerHTML={ { __html: content } }></div>
			</div>
		);
	},
	save: ( props ) => {
		const {
			attributes: {
				title,
				content,
			},
		} = props;
		return (
			<div className="agiledrop-card">
				<RichText.Content tagName="h3" value={ title } />
				<div class="agiledrop-card__content" dangerouslySetInnerHTML={ { __html: content } }></div>
			</div>
		);
	},
} );
