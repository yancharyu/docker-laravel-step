<template>
  <form class="p-home__authForm" method="post" @submit.prevent="apiRegister">
    <div class="c-form__item">
      <input
        type="text"
        name="username"
        :class="{ 'p-home__input': true, 'p-home__input--error': errorMessages.username && errorMessages.username[0] }"
        :placeholder="$t('ユーザーネーム')"
        v-model="register.username"
      />
      <template v-if="errorMessages.username && errorMessages.username[0]">
        <span class="p-home__errMsg u-require" role="alert">
          <strong>{{ errorMessages.username[0] }}</strong>
        </span>
      </template>
    </div>
    <div class="c-form__item">
      <input
        type="text"
        name="email"
        :class="{ 'p-home__input': true, 'p-home__input--error': errorMessages.email && errorMessages.email[0] }"
        :placeholder="$t('メールアドレス')"
        v-model="register.email"
      />
      <template v-if="errorMessages.email && errorMessages.email[0]">
        <span class="p-home__errMsg u-require" role="alert">
          <strong>{{ errorMessages.email[0] }}</strong>
        </span>
      </template>
    </div>
    <div class="c-form__item">
      <input
        type="password"
        name="password"
        :class="{
          'p-home__input': true,
          'p-home__input--error': errorMessages.password && errorMessages.password[0],
        }"
        :placeholder="$t('パスワード')"
        v-model="register.password"
      />
      <template v-if="errorMessages.password && errorMessages.password[0]">
        <span class="p-home__errMsg u-require" role="alert">
          <strong>{{ errorMessages.password[0] }}</strong>
        </span>
      </template>
    </div>
    <div class="c-form__item">
      <input
        type="password"
        name="password_confirmation"
        class="p-home__input"
        :placeholder="$t('パスワード確認用')"
        v-model="register.password_confirmation"
      />
    </div>
    <div class="c-btnContainer">
      <button class="c-btn c-btn--widthMax">{{ $t('新規登録') }}</button>
    </div>
  </form>
</template>

<script>
export default {
  data() {
    return {
      register: {
        username: '',
        email: '',
        password: '',
        password_confirmation: '',
      },
      errorMessages: () => [],
    };
  },
  methods: {
    async apiRegister() {
      // console.log(this.register);
      try {
        const res = await axios.post('/api/register', this.register);
        console.log(res.status);
        console.log(res.data);
        console.log(res.statusText);
        if (res.status === 200 && res.statusText === 'OK') {
          // window.location.href = '/step';
        }
      } catch (e) {
        this.errorMessages = e.response.data.errors;
      }
    },
  },
};
</script>
