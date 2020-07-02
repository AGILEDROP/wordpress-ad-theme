const { task, src, dest, watch, series } = require('gulp');
const concat = require('gulp-concat-util');
const babel = require('gulp-babel');

const block = {
    header: `(function (wp) {
    const { registerBlockType } = wp.blocks;
    const { RichText, MediaUpload, InspectorControls} = wp.editor;
    const {components, editor, blocks, element, i18n  } = wp;
    const { SelectControl, Button, RadioControl, ToggleControl } = wp.components;
    const { Component } = wp.element;
    const apiFetch = wp.apiFetch;
     `,
    footer: `})(window.wp);`
}


task('js', () => {
    return src('./src/index.js')
        .pipe(concat.header(block.header))
        .pipe(concat.footer(block.footer))
        .pipe(babel({
            presets: ['@babel/preset-react']
        }))
        .pipe(dest('dist/'))
});

task('watch',() => {
    watch('./src/index.js', series('js'));
});