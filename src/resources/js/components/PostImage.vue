<script>
export default {
  props: {
    // 画像のパス
    imagePath: {
      type: String,
      required: true,
    },
    // エラーがあれば表示するようのメッセージ
  },
  data() {
    return {
      postData: '',
      sizeErrorMessage: '',
    };
  },
  methods: {
    /**
     * fileが挿入された時の処理
     */

    onFileChange(e) {
      const files = e.target.files[0];
      const maxFileSize = 3072000;

      // ファイルサイズが最大サイズより大きかったらエラーメッセージを表示してinput内を空にする
      if (files.size >= maxFileSize) {
        const fileInput = $('.js-fileInput');
        fileInput.value = '';
        this.sizeErrorMessage = '画像サイズが大きすぎます';
        return;
      }

      // エラーメッセージリセット
      this.sizeErrorMessage = '';
      this.createImage(files);
    },

    /**
     * ファイルローダーを作成
     * @param {object} file ファイル
     */
    createImage(file) {
      const reader = new FileReader();
      reader.onload = e => {
        this.postData = e.target.result;
      };
      reader.readAsDataURL(file);
    },
  },
};
</script>
