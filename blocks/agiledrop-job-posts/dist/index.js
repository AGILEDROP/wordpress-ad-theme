(function (wp) {
  const {
    registerBlockType
  } = wp.blocks;
  const {
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
    SelectControl,
    CheckboxControl,
    RadioControl
  } = wp.components;
  const apiFetch = wp.apiFetch;
  registerBlockType('agiledrop/agiledrop-job-posts', {
    title: 'Job Posts',
    icon: 'universal-access-alt',
    category: 'layout',
    attributes: {
      runPostTypes: {
        default: true
      },
      postTypes: [],
      runDefaultPostType: {
        default: true
      },
      selectedPostType: {
        default: ''
      },
      runGetAllPosts: {
        default: true
      },
      posts: [],
      runCheckBoxes: {
        default: true
      },
      selectedRadioButton: {
        default: 3
      }
    },
    edit: props => {
      const {
        attributes: {
          runPostTypes,
          postTypes,
          runDefaultPostType,
          selectedPostType,
          runGetAllPosts,
          posts,
          runCheckBoxes,
          selectedRadioButton
        },
        setAttributes
      } = props; //Get all post types. Run only once.

      const getPostTypes = () => {
        if (runPostTypes) {
          apiFetch({
            path: '/agiledrop/v1/custom-post-types'
          }).then(types => {
            if (types.length) {
              let values = types.map(name => {
                return {
                  value: name,
                  label: name
                };
              });
              values.unshift({
                value: 'Select Post Type',
                label: 'Select Post Type'
              });
              setAttributes({
                postTypes: values
              });
            }
          });
          setAttributes({
            runPostTypes: false
          });
        }
      };

      getPostTypes(); //Set default post type. Run only once

      const defaultPostType = () => {
        if (runDefaultPostType) {
          if (postTypes !== undefined) {
            setAttributes({
              runDefaultPostType: false,
              selectedPostType: postTypes[0]
            });
          }
        }
      };

      defaultPostType(); //Change post type on user click.

      const updatePostType = value => {
        let together = {
          value: value,
          label: value
        };
        setAttributes({
          selectedPostType: together,
          runPrepareDisplay: true
        });
      }; //Get all post from all post types. Run only once.


      const getAllPosts = () => {
        if (runGetAllPosts) {
          if (postTypes !== undefined) {
            let allPosts = [];
            postTypes.map(postType => {
              if (postType.label !== 'Select Post Type') {
                apiFetch({
                  path: '/agiledrop/v1/' + postType.label
                }).then(posts => {
                  for (let i in posts) {
                    let a;

                    if (posts.hasOwnProperty(i)) {
                      a = {
                        type: postType.label,
                        id: i,
                        title: posts[i].title,
                        content: posts[i].text,
                        img: posts[i].image,
                        linkText: posts[i].link_text,
                        link: posts[i].link,
                        checked: true
                      };
                    }

                    allPosts.push(a);
                  }
                });
              }
            });
            setAttributes({
              runGetAllPosts: false,
              posts: allPosts
            });
          }
        }
      };

      getAllPosts(); //Create checkboxes for choosing posts. Run on post type change.

      const createCheckBoxes = () => {
        if (runCheckBoxes) {
          if (posts !== undefined && selectedPostType.label !== undefined) {
            let checkBoxes = posts.map(post => {
              if (post.type === selectedPostType.label) {
                return /*#__PURE__*/React.createElement(CheckboxControl, {
                  label: post.title,
                  checked: post.checked,
                  onChange: status => clickCheckBox(post.id, status)
                });
              }
            });
            return checkBoxes;
          }
        }
      }; //Update post checked status. Run on user click.


      const clickCheckBox = (postId, status) => {
        let updatePosts = posts.map(post => {
          if (post.id === postId) {
            post.checked = status;
          }

          return post;
        });
        setAttributes({
          posts: updatePosts
        });
      }; //Update radio button. Run on user click.


      const updateRadioButton = value => {
        setAttributes({
          selectedRadioButton: parseInt(value, 10)
        });
      }; //Prepare container for display..


      const getDisplay = () => {
        if (selectedPostType !== undefined && posts !== undefined) {
          let numOfCol = 0;
          let testRows = [];
          const columns = posts.filter(post => {
            return post.checked === true && post.type === selectedPostType.label;
          }).map(post => {
            numOfCol++;
            return /*#__PURE__*/React.createElement("div", {
              className: "agiledrop-column"
            }, /*#__PURE__*/React.createElement("img", {
              src: post.img
            }), /*#__PURE__*/React.createElement("h1", null, post.title), /*#__PURE__*/React.createElement("p", null, post.content), /*#__PURE__*/React.createElement("a", {
              href: post.link
            }, post.linkText));
          });

          if (numOfCol !== 0) {
            for (let i = 0; i < Math.ceil(numOfCol / selectedRadioButton); i++) {
              testRows.push(i);
            }
          }

          const arr = new Array(selectedRadioButton).fill(0);
          let b = -1;
          return testRows.map(row => {
            return /*#__PURE__*/React.createElement("div", {
              className: "agiledrop-row"
            }, arr.map(a => {
              b++;
              return columns[b];
            }));
          });
        }
      };

      const selectPostType = () => {
        if (selectedPostType.label === "Select Post Type") {
          return /*#__PURE__*/React.createElement("h2", null, "Please Select Post Type");
        }

        return getDisplay();
      };

      return /*#__PURE__*/React.createElement("div", {
        className: "agiledrop-block container"
      }, /*#__PURE__*/React.createElement(InspectorControls, null, /*#__PURE__*/React.createElement(SelectControl, {
        label: "Select Post type",
        value: selectedPostType.value,
        options: postTypes,
        onChange: updatePostType
      }), createCheckBoxes(), /*#__PURE__*/React.createElement(RadioControl, {
        label: "Select Columns",
        selected: selectedRadioButton,
        options: [{
          label: '1-column',
          value: 1
        }, {
          label: '2-columns',
          value: 2
        }, {
          label: '3-columns',
          value: 3
        }],
        onChange: selected => updateRadioButton(selected)
      })), selectPostType());
    },
    save: props => {
      const {
        selectPostType
      } = props;
      return /*#__PURE__*/React.createElement("div", {
        className: "agiledrop-block container"
      }, selectPostType);
    }
  });
})(window.wp);