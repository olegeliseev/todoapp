<template>
    <div>
        <h2>Добавить новую задачу</h2>
        <form @submit.prevent="addTask">
            <input type="text" v-model="title" placeholder="Введите название задачи" required>
            <button type="submit">Добавить</button>
        </form>
    </div>
</template>

<script>
export default {
    data() {
        return {
            title: ''
        };
    },
    methods: {
        async addTask() {
            try {
                await axios.post('/api/tasks', { title: this.title });
                this.title = '';
                this.$emit('taskAdded');
            } catch (error) {
                console.error('Ошибка при добавлении задачи:', error);
            }
        }
    }
};
</script>
