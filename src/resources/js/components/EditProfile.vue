<template>
  <div class="p-mypage__main">
    <vue-modal v-show="isShowModal">
      <template v-slot:content>
        <div class="c-modal__inner p-editProfile__modal">
          <h1 class="c-modal__title">{{ $t('変更しました') }}</h1>
          <button class="c-btn c-modal__button" @click="closeModal">閉じる</button>
        </div>
      </template>
    </vue-modal>
    <vue-modal v-show="isLoading">
      <template v-slot:content>
        <div class="c-modal__inner c-modal__inner--hrCenter">
          <h1 class="c-modal__title">{{ $t('変更中...') }}</h1>
        </div>
      </template>
    </vue-modal>
    <form method="POST" class="p-editProfile" enctype="multipart/form-data" @submit.prevent="editProfile">
      <div class="c-form__item p-editProfile__picContainer">
        <!-- 画像が挿入されていればその画像、なければデータベースの画像 -->
        <img :src="prevImage ? prevImage : getUserProfilePic" class="p-editProfile__profileImage js-prevImage" />

        <!-- プロフィール画像 -->
        <label for="js-fileInput" class="p-fileInput">
          <span class="p-fileInput__button">{{ $t('写真を選択') }}</span>
          <input type="file" name="pic" id="js-fileInput" class="p-fileInput__input" @change="onFileChange" />
        </label>
        <!-- エラーメッセージ -->
        <span class="u-require">
          <!-- <strong>{{ errorMessage }}</strong> -->
        </span>
        <!-- サイズエラーメッセージ -->
        <span class="u-require">
          <strong>{{ sizeErrorMessage }}</strong>
        </span>
      </div>

      <!-- ユーザーネーム -->
      <!-- </.c-form__item> -->
      <div class="c-form__item">
        <label for="name">
          {{ $t('ユーザーネーム(30文字以内)') }}
          <input type="text" name="name" id="name" class="c-input" v-model="editProfileFormData.name" />
        </label>
      </div>

      <!-- メールアドレス -->
      <div class="c-form__item">
        <label for="email">
          {{ $t('メールアドレス') }}
          <input type="text" name="email" id="email" class="c-input" v-model="editProfileFormData.email" />
        </label>
      </div>

      <!-- 自己紹介 -->
      <div class="c-form__item">
        <label for="introduction">
          {{ $t('自己紹介') }}（{{ maxLength }}{{ $t('文字以内') }}）
          <textarea
            name="introduction"
            id="introduction"
            cols="40"
            rows="10"
            :class="{ 'c-textarea': true }"
            v-model="editProfileFormData.introduction"
          >
          </textarea>
        </label>

        <!-- 文字数カウンター -->
        <div class="c-textarea__count">
          <!-- 最大文字数を超えたら文字色を赤にする -->
          <span
            class="c-textarea__countNum"
            :class="{
              'c-textarea__countNum--over':
                editProfileFormData.introduction && editProfileFormData.introduction.length > maxLength,
            }"
            >{{ editProfileFormData.introduction ? editProfileFormData.introduction.length : 0 }}</span
          >
          /
          {{ maxLength }}
        </div>

        <!-- エラーメッセージが渡されてきたら表示する -->
        <!-- <template v-if="errorMessage.length">
          <span class="u-require">{{ errorMessage }}</span>
        </template> -->
      </div>

      <!-- ボタン -->
      <div class="c-btnContainer">
        <button class="c-btn c-btn--flRight">{{ $t('保存') }}</button>
      </div>
    </form>
  </div>
</template>

<script>
import { mapGetters, mapActions } from 'vuex';
import Modal from './Modal.vue';

export default {
  data() {
    return {
      // フォームを表示するかどうか
      isShowModal: false,
      // formの値
      editProfileFormData: {
        pic: '',
        name: null,
        email: null,
        introduction: null,
      },
      prevImage: null,
      errorMessages: [], // formのエラーメッセージ用
      sizeErrorMessage: '', // サイズエラーメッセージ用
      maxLength: 1000, // textareaの最大文字数
      isLoading: false,
    };
  },
  components: {
    'vue-modal': Modal,
  },
  computed: {
    ...mapGetters(['getUser', 'getUserProfilePic']),
  },
  methods: {
    ...mapActions(['setUser']),
    /**
     * 最初のレンダリング時にformDataをセットする
     */
    setFormData() {
      const user = this.getUser;
      this.editProfileFormData.name = user.name;
      this.editProfileFormData.email = user.email;
      this.editProfileFormData.introduction = user.introduction;
    },

    /**
     * fileが挿入された時の処理
     */
    onFileChange(e) {
      const file = e.target.files[0];
      const maxFileSize = 1048576;

      // ファイルサイズが最大サイズより大きかったらエラーメッセージを表示してinput内を空にする
      if (file.size >= maxFileSize) {
        const fileInput = $('.js-fileInput');
        fileInput.value = '';
        this.sizeErrorMessage = '画像サイズが大きすぎます';
        return;
      }

      // エラーメッセージリセット
      this.sizeErrorMessage = '';
      this.editProfileFormData.pic = file;
      this.createImage(file);
    },

    /**
     * 画像プレビュー用のファイルローダーを作成
     * @param {object} file 画像のオブジェクト
     */
    createImage(file) {
      const reader = new FileReader();
      reader.readAsDataURL(file);
      reader.onload = e => {
        this.prevImage = e.target.result;
      };
    },

    /**
     * プロフィール変更処理
     */
    async editProfile() {
      const formData = new FormData();
      formData.append('pic', this.editProfileFormData.pic);
      formData.append('name', this.editProfileFormData.name);
      formData.append('email', this.editProfileFormData.email);
      formData.append('introduction', this.editProfileFormData.introduction);
      try {
        this.isLoading = true;
        const res = await axios.post('/api/edit_profile', formData);
        this.isLoading = false;
        this.setUser(res.data.user);
        this.showModal();
      } catch (e) {
        console.log(e.response.data.errors);
      }
    },
    showModal() {
      this.isShowModal = true;
    },
    closeModal() {
      this.isShowModal = false;
    },
  },
  created() {
    this.setFormData();
  },
};
</script>
