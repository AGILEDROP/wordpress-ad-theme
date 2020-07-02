registerBlockType( 'agiledrop/agiledrop-two-columns', {
	title: 'Agiledrop Two Columns',
	icon: 'index-card',
	category: 'layout',
	attributes: {
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
		imageId: {
			type: 'number',
		},
		imageUrl: {
			type: 'string',
			source: 'attribute',
			selector: 'img',
			attribute: 'src',
		},
		videoId:{
			type: 'number',
		},
		videoUrl: {
			type: 'string',
			source: 'attribute',
			selector: 'source',
			attribute: 'src',
		},
		reverse: {
			default: false
		},
		contentClass: {
			default: 'twocolumns',
		},
		background: {
			default: false,
		},
		backgroundClass:{
			default: ''
		},
		selectedMedia: {
			default: 'image'
		},
		mediaClass: {
			default: 'twocolumns__image'
		}
	},
	edit: ( props ) => {
		const {
			attributes: {
				title,
				description,
				imageId,
				videoId,
				imageUrl,
				videoUrl,
				contentClass,
				reverse,
				background,
				backgroundClass,
				selectedMedia,
				mediaClass
			},
			setAttributes,
		} = props;
		const onChangeTitle = ( value ) => {
			setAttributes( { title: value } );
		};

		const onSelectMedia = ( media ) => {
			if ( selectedMedia === 'image') {
				setAttributes( { imageUrl: media.url, imageId: media.id, videoUrl: '', videoId: '' } );
			}
			if ( selectedMedia === 'video' ) {
				setAttributes( { videoUrl: media.url, videoId: media.id, imageUrl: '', imageId: '' } );
			}
		};

		const onChangeDescription = ( value ) => {
			setAttributes( { description: value } );
		};

		const onChangeReverse = ( value ) => {
			setAttributes( { reverse: value } )
			if ( value ) {
				setAttributes( { contentClass: 'twocolumns twocolumns__reverse' } );
			}
			else {
				setAttributes( { contentClass: 'twocolumns' } );
			}
		}

		const onChangeBackground = ( value ) => {
			setAttributes( { background: value } );
			if ( value ) {
				setAttributes( { backgroundClass: 'twocolumns__background' } );
			}
			else {
				setAttributes( { backgroundClass: '' } );
			}
		}

		const onChangeMedia = ( value ) => {
			setAttributes( { selectedMedia: value } );
			if ( value === 'image' ) {
				setAttributes( { mediaClass: 'twocolumns__image' } );
			}
			if ( value === 'video' ) {
				setAttributes( { mediaClass: 'twocolumns__video' } );
			}
		}

		//This is here because, set allowedTypes dynamically based on which type is used not working.
		const checkFile = ( src, type ) => {
			if ( type === 'image' ) {
				if( src.match(/.(jpg|jpeg|png|gif)$/i) ) {
					return ( <img src={ src } />);
				}
				else {
					setAttributes( { imageUrl: '', imageId: ''} );
				}
			}
			if ( type === 'video') {
				if( src.match(/.(mov|avi|mp4|m4p|webm|mpg|mp2|mpeg|mpe|mpv|ogg|m4v|wmv|qt|flv)$/i) ) {
					return ( <video width="320" height="240" >
						<source src={src} type="video/mp4"/>
					</video>);
				}
				else {
					setAttributes( { videoUrl: '', videoId: '' } );
				}
			}

		}

		const mediaButton = ( open ) => {
			if ( selectedMedia === 'image' ) {
				return (
					<Button className={ imageId ? 'image-button' : 'button button-large' } onClick={ open }>
						{ ! imageId ? 'Upload Image' :  checkFile( imageUrl, 'image' ) }
					</Button>
				)
			}
			if ( selectedMedia === 'video') {
				return (
					<Button className={ videoId ? 'image-button' : 'button button-large' } onClick={ open }>
						{!videoId ? 'Upload Video' : checkFile( videoUrl, 'video' ) }
					</Button>
				)
			}
		}

		return (
			<div className={[ contentClass, backgroundClass, mediaClass ].join(' ') }>
				<div className="twocolumns__container">
					<InspectorControls>
						<RadioControl
							label={ 'Select media to upload' }
							selected={ selectedMedia }
							options={ [
								{ label: 'Image', value: 'image' },
								{ label: 'Video', value: 'video' },
							] }
							onChange={ onChangeMedia }
						/>
						<ToggleControl
							label={ 'Reverse Columns' }
							help={ reverse ? 'Text is on right and media on left.' :  'Text is on left and media on right.' }
							checked={ reverse }
							onChange={ onChangeReverse }
						/>
						<ToggleControl
							label={ 'Add Grey Background' }
							help={ background ? 'Grey Background is applied.' :  'No background.' }
							checked={ background }
							onChange={ onChangeBackground }
						/>
					</InspectorControls>
					<div className="twocolumns__item">
						<RichText
							tagName="h2"
							placeholder={ 'Insert Title' }
							value={ title }
							onChange={ onChangeTitle }
						/>
						<RichText
							tagName="p"
							placeholder={ 'Insert Description' }
							value={ description }
							onChange={ onChangeDescription }
						/>
					</div>
					<div className="twocolumns__item">
						<MediaUpload
							onSelect={ onSelectMedia }
							allowedTypes="image, video"
							value={ imageId }
							render={ ( { open } ) => (
								mediaButton( open )
							) }
						/>
					</div>
				</div>
			</div>
		);
	},
	save: ( props ) => {
		const {
			attributes: {
				title,
				description,
				imageUrl,
				videoUrl,
				contentClass,
				backgroundClass,
				selectedMedia,
				mediaClass
			},
		} = props;

		const displayMedia = () => {
			if ( selectedMedia === 'image' && imageUrl ) {
				return(
					<img className="twocolumns__image" src={ imageUrl } alt={ 'Image' } />
				)
			}
			if ( selectedMedia === 'video' && videoUrl ) {
				return (
					<video width="320" height="240" autoplay>
						<source src={ videoUrl} type="video/mp4" />
					</video>
				)
			}
		}
		return (
			<div className={ [ contentClass, backgroundClass, mediaClass ].join(' ') }>
				<div className="twocolumns__container">
					<div className="twocolumns__item">
						<RichText.Content tagName="h2" value={ title } />
						<RichText.Content tagName="p" value={ description } />
					</div>
					<div className="twocolumns__item">
						{
							displayMedia()
						}
					</div>
				</div>
			</div>
		);
	},
} );
