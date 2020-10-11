module.exports = {
  root: true,
  env: {
    browser: true, // グローバルオブジェクト「window」とかが書けるようになる。
    commonjs: true, // 「require」とかが書けるようになる。
    es6: true, // ES6の構文が書けるようになる。
    node: true,
  },

  extends: [
    'eslint:recommended',
    'plugin:vue/strongly-recommended',
    'plugin:json/recommended',
    'airbnb-base', // Reactを使う場合は、airbnb
    'prettier/vue',
    'plugin:prettier/recommended', // 記述位置が重要。一番最後に書く。
  ],
  globals: {
    Atomics: 'readonly',
    SharedArrayBuffer: 'readonly',
  },
  parserOptions: {
    parser: 'babel-eslint',
    ecmaVersion: 2018,
    sourceType: 'module', // 「import」構文とか書けるようになる。
  },
  // prettier連携
  plugins: ['vue', 'prettier'],
  rules: {
    // prettier連携
    'prettier/prettier': ['error'],
    'vue/no-v-html': 'off',
    'no-console': 0,
    'no-param-reassign': 0,
    'import/no-named-as-default': 0,
    'import/no-named-as-default-member': 0,
    'import/no-unresolved': 'off',
    'import/prefer-default-export': 'off',
    'no-plusplus': 'off',
    'no-shadow': ['error', { allow: ['state'] }],
    'no-empty': 'off',
    // ループ処理をfor of 以外禁止にする
    'no-restricted-syntax': [
      'error',
      {
        selector: 'ForInStatement',
        message:
          'for..in loops iterate over the entire prototype chain, which is virtually never what you want. Use Object.{keys,values,entries}, and iterate over the resulting array.',
      },
      {
        selector: 'LabeledStatement',
        message: 'Labels are a form of GOTO; using them makes code confusing and hard to maintain and understand.',
      },
      {
        selector: 'WithStatement',
        message: '`with` is disallowed in strict mode because it makes code impossible to predict and optimize.',
      },
    ],
    'import/no-extraneous-dependencies': [
      'error',
      {
        devDependencies: true, // devDependenciesのimportを許可
        optionalDependencies: false,
      },
    ],
    'no-irregular-whitespace': [
      'error',
      {
        skipRegExps: true,
        skipComments: true,
      },
    ],
    'func-names': 'off',
    // Laravelの時のみこれをoffにする
    'no-undef': 'off',
    'prefer-destructuring': ['error', { object: true, array: false }],
  },
};
