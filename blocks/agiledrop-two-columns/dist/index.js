(function (wp) {
  const {
    registerBlockType
  } = wp.blocks;
  const {
    RichText,
    MediaUpload,
    InspectorControls
  } = wp.editor;
  const {
    components,
    editor,
    blocks,
    element,
    i18n
  } = wp;
  const {
    Button,
    RadioControl,
    ToggleControl
  } = wp.components;
  registerBlockType('agiledrop/agiledrop-two-columns', {
    title: 'Agiledrop Two Columns',
    icon: 'index-card',
    category: 'layout',
    attributes: {
      title: {
        type: 'array',
        source: 'children',
        selector: 'h2'
      },
      description: {
        type: 'array',
        source: 'children',
        selector: 'p'
      },
      imageId: {
        type: 'number'
      },
      imageUrl: {
        type: 'string',
        source: 'attribute',
        selector: 'img',
        attribute: 'src'
      },
      videoId: {
        type: 'number'
      },
      videoUrl: {
        type: 'string',
        source: 'attribute',
        selector: 'source',
        attribute: 'src'
      },
      reverse: {
        default: false
      },
      contentClass: {
        default: 'twocolumns'
      },
      background: {
        default: false
      },
      backgroundClass: {
        default: ''
      },
      selectedMedia: {
        default: 'image'
      },
      mediaClass: {
        default: 'twocolumns__image'
      }
    },
    edit: props => {
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
        setAttributes
      } = props;

      const onChangeTitle = value => {
        setAttributes({
          title: value
        });
      };

      const onSelectMedia = media => {
        if (selectedMedia === 'image') {
          setAttributes({
            imageUrl: media.url,
            imageId: media.id,
            videoUrl: '',
            videoId: ''
          });
        }

        if (selectedMedia === 'video') {
          setAttributes({
            videoUrl: media.url,
            videoId: media.id,
            imageUrl: '',
            imageId: ''
          });
        }
      };

      const onChangeDescription = value => {
        setAttributes({
          description: value
        });
      };

      const onChangeReverse = value => {
        setAttributes({
          reverse: value
        });

        if (value) {
          setAttributes({
            contentClass: 'twocolumns twocolumns__reverse'
          });
        } else {
          setAttributes({
            contentClass: 'twocolumns'
          });
        }
      };

      const onChangeBackground = value => {
        setAttributes({
          background: value
        });

        if (value) {
          setAttributes({
            backgroundClass: 'twocolumns__background'
          });
        } else {
          setAttributes({
            backgroundClass: ''
          });
        }
      };

      const onChangeMedia = value => {
        setAttributes({
          selectedMedia: value
        });

        if (value === 'image') {
          setAttributes({
            mediaClass: 'twocolumns__image'
          });
        }

        if (value === 'video') {
          setAttributes({
            mediaClass: 'twocolumns__video'
          });
        }
      }; //This is here because, set allowedTypes dynamically based on which type is used not working.


      const checkFile = (src, type) => {
        if (type === 'image') {
          if (src.match(/.(jpg|jpeg|png|gif)$/i)) {
            return /*#__PURE__*/React.createElement("img", {
              src: src
            });
          } else {
            setAttributes({
              imageUrl: '',
              imageId: ''
            });
          }
        }

        if (type === 'video') {
          if (src.match(/.(mov|avi|mp4|m4p|webm|mpg|mp2|mpeg|mpe|mpv|ogg|m4v|wmv|qt|flv)$/i)) {
            return /*#__PURE__*/React.createElement("video", {
              width: "320",
              height: "240"
            }, /*#__PURE__*/React.createElement("source", {
              src: src,
              type: "video/mp4"
            }));
          } else {
            setAttributes({
              videoUrl: '',
              videoId: ''
            });
          }
        }
      };

      const mediaButton = open => {
        if (selectedMedia === 'image') {
          return /*#__PURE__*/React.createElement(Button, {
            className: imageId ? 'image-button' : 'button button-large',
            onClick: open
          }, !imageId ? 'Upload Image' : checkFile(imageUrl, 'image'));
        }

        if (selectedMedia === 'video') {
          return /*#__PURE__*/React.createElement(Button, {
            className: videoId ? 'image-button' : 'button button-large',
            onClick: open
          }, !videoId ? 'Upload Video' : checkFile(videoUrl, 'video'));
        }
      };

      return /*#__PURE__*/React.createElement("div", {
        className: [contentClass, backgroundClass, mediaClass].join(' ')
      }, /*#__PURE__*/React.createElement("div", {
        className: "twocolumns__container"
      }, /*#__PURE__*/React.createElement(InspectorControls, null, /*#__PURE__*/React.createElement(RadioControl, {
        label: 'Select media to upload',
        selected: selectedMedia,
        options: [{
          label: 'Image',
          value: 'image'
        }, {
          label: 'Video',
          value: 'video'
        }],
        onChange: onChangeMedia
      }), /*#__PURE__*/React.createElement(ToggleControl, {
        label: 'Reverse Columns',
        help: reverse ? 'Text is on right and media on left.' : 'Text is on left and media on right.',
        checked: reverse,
        onChange: onChangeReverse
      }), /*#__PURE__*/React.createElement(ToggleControl, {
        label: 'Add Grey Background',
        help: background ? 'Grey Background is applied.' : 'No background.',
        checked: background,
        onChange: onChangeBackground
      })), /*#__PURE__*/React.createElement("div", {
        className: "twocolumns__item"
      }, /*#__PURE__*/React.createElement(RichText, {
        tagName: "h2",
        placeholder: 'Insert Title',
        value: title,
        onChange: onChangeTitle
      }), /*#__PURE__*/React.createElement(RichText, {
        tagName: "p",
        placeholder: 'Insert Description',
        value: description,
        onChange: onChangeDescription
      })), /*#__PURE__*/React.createElement("div", {
        className: "twocolumns__item"
      }, /*#__PURE__*/React.createElement(MediaUpload, {
        onSelect: onSelectMedia,
        allowedTypes: "image, video",
        value: imageId,
        render: ({
          open
        }) => mediaButton(open)
      }))));
    },
    save: props => {
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
        }
      } = props;

      const displayMedia = () => {
        if (selectedMedia === 'image' && imageUrl) {
          return /*#__PURE__*/React.createElement("img", {
            className: "twocolumns__image",
            src: imageUrl,
            alt: 'Image'
          });
        }

        if (selectedMedia === 'video' && videoUrl) {
          return /*#__PURE__*/React.createElement("video", {
            width: "320",
            height: "240",
            autoplay: true
          }, /*#__PURE__*/React.createElement("source", {
            src: videoUrl,
            type: "video/mp4"
          }));
        }
      };

      return /*#__PURE__*/React.createElement("div", {
        className: [contentClass, backgroundClass, mediaClass].join(' ')
      }, /*#__PURE__*/React.createElement("div", {
        className: "twocolumns__container"
      }, /*#__PURE__*/React.createElement("div", {
        className: "twocolumns__item"
      }, /*#__PURE__*/React.createElement(RichText.Content, {
        tagName: "h2",
        value: title
      }), /*#__PURE__*/React.createElement(RichText.Content, {
        tagName: "p",
        value: description
      })), /*#__PURE__*/React.createElement("div", {
        className: "twocolumns__item"
      }, displayMedia())));
    }
  });
})(window.wp);