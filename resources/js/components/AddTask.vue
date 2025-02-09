<template>
    <form @submit.prevent="addTask">
        <div class="flex mb-4">
            <input class="w-full px-4 py-2 mr-2 rounded-lg border-gray-300 focus:outline-none focus:border-blue-500"
                   type="text"
                   v-model="title"
                   placeholder="Введите название задачи"
                   required>
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" type="submit">Добавить</button>
        </div>
    </form>
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
                await axios.post('/api/tasks', {title: this.title});
                this.title = '';
                this.$emit('taskAdded');
            } catch (error) {
                console.error('Ошибка при добавлении задачи:', error);
            }
        }
    }
};
</script>
