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
  const apiFetch = wp.apiFetch;
  registerBlockType('agiledrop/agiledrop-categories', {
    title: 'Agiledrop Categories',
    icon: 'index-card',
    category: 'layout',
    attributes: {
      runGetCategories: {
        default: true
      },
      categories: [],
      selectedCategory: {
        default: 1
      },
      runGetPosts: {
        default: true
      },
      selectPost: [],
      selectedPost: {},
      title: {
        type: 'array',
        source: 'children',
        selector: 'h2'
      },
      content: {
        type: 'array',
        source: 'children',
        selector: 'p'
      }
    },
    edit: props => {
      const {
        attributes: {
          runGetCategories,
          categories,
          selectedCategory,
          selectPost,
          selectedPost,
          runGetPosts,
          title,
          content
        },
        setAttributes
      } = props;
      let posts = [];

      const getAllCategories = () => {
        if (runGetCategories) {
          apiFetch({
            path: '/wp/v2/categories'
          }).then(categories => {
            let allCategories = categories.map(obj => {
              return {
                value: obj.id,
                label: obj.name
              };
            });
            setAttributes({
              categories: allCategories
            });
          });
          setAttributes({
            runGetCategories: false
          });
        }
      };

      getAllCategories();

      const getPostsFromCategory = () => {
        if (runGetPosts) {
          apiFetch({
            path: '/wp/v2/posts/?categories=' + selectedCategory
          }).then(posts => {
            let allPosts = posts.map(obj => {
              return {
                id: obj.id,
                content: obj.content.rendered,
                title: obj.title.rendered
              };
            });
            let selectPosts = posts.map(obj => {
              return {
                value: obj.id,
                label: obj.title.rendered
              };
            });
            this.posts = allPosts;
            setAttributes({
              selectPost: selectPosts
            });
          });
          setAttributes({
            runGetPosts: false
          });
        }
      };

      getPostsFromCategory();

      const onChangeCategory = value => {
        setAttributes({
          selectedCategory: parseInt(value),
          runGetPosts: true,
          selectedPost: ''
        });
      };

      const onChangePost = value => {
        setAttributes({
          selectedPost: parseInt(value)
        });
      };

      const savePost = () => {
        if (this.posts) {
          this.posts.map(post => {
            if (post.id === selectedPost) {
              setAttributes({
                title: post.title,
                content: post.content
              });
            }
          });
        }
      };

      savePost();
      return /*#__PURE__*/React.createElement("div", {
        className: "agiledrop-card"
      }, /*#__PURE__*/React.createElement(InspectorControls, null, /*#__PURE__*/React.createElement(RadioControl, {
        label: "Select Category",
        selected: selectedCategory,
        options: categories,
        onChange: onChangeCategory
      }), /*#__PURE__*/React.createElement(RadioControl, {
        label: "Select Post",
        selected: selectedPost,
        options: selectPost,
        onChange: onChangePost
      })), /*#__PURE__*/React.createElement(RichText.Content, {
        tagName: "h2",
        value: title
      }), /*#__PURE__*/React.createElement(RichText.Content, {
        tagName: "p",
        value: content
      }));
    },
    save: props => {
      const {
        attributes: {
          title,
          content
        }
      } = props;
      return /*#__PURE__*/React.createElement("div", {
        className: "agiledrop-card"
      }, /*#__PURE__*/React.createElement(RichText.Content, {
        tagName: "h2",
        value: title
      }), /*#__PURE__*/React.createElement(RichText.Content, {
        tagName: "p",
        value: content
      }));
    }
  });
})(window.wp);