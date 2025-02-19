<template>
  <div class="profile-settings p-4 rounded shadow">
    <h3 class="mb-4">Настройки профиля</h3>
    <form @submit.prevent="handleSubmit">
      <div class="mb-3">
        <label for="firstName" class="form-label">Имя</label>
        <input type="text" class="form-control" id="firstName" v-model="formData.first_name" required />
      </div>
      <div class="mb-3">
        <label for="lastName" class="form-label">Фамилия</label>
        <input type="text" class="form-control" id="lastName" v-model="formData.last_name" required />
      </div>
      <div class="mb-3">
        <label for="birthdate" class="form-label">Дата рождения</label>
        <input type="date" class="form-control" id="birthdate" v-model="formData.birthdate" required />
      </div>
      <div class="mb-3">
        <label for="phone" class="form-label">Номер телефона</label>
        <input type="tel" class="form-control" id="phone" v-model="formData.phone" required />
      </div>
      <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" v-model="formData.email" required />
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Пароль</label>
        <input type="password" class="form-control" id="password" v-model="formData.password" required />
      </div>
      <button type="submit" class="btn btn-primary w-100">Сохранить изменения</button>
    </form>
  </div>
</template>

<script>
export default {
  name: 'ProfileSettings',
  props: {
    user: {
      type: Object,
      required: true
    }
  },
  data() {
    return {
      formData: { 
        first_name: this.user.first_name,
        last_name: this.user.last_name,
        birthdate: this.user.birthdate?.split('T')[0],
        phone: this.user.phone,
        email: this.user.email,
        password: ''
      }
    };
  },
  methods: {
    handleSubmit() {
      this.$emit('update-user', this.formData);
    }
  }
};
</script>

<style scoped>
.profile-settings {
  background: linear-gradient(135deg, #2a2a40, #1e1e2f);
  border: 1px solid rgba(255, 107, 53, 0.2);
}

h3 {
  color: #ff6b35;
}

.form-control {
  background-color: rgba(255, 255, 255, 0.1);
  border: 1px solid rgba(255, 255, 255, 0.2);
  color: #ffffff;
}

.form-control:focus {
  background-color: rgba(255, 255, 255, 0.2);
  border-color: #ff6b35;
  box-shadow: 0 0 0 0.2rem rgba(255, 107, 53, 0.25);
}
</style>