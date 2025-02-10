<template>
    <div>
        <ul>
            <li
                class="border-b border-gray-200 flex items-center justify-between py-4 h-12"
                :class="{ 'completed': task.completed }"
                v-for="task in tasks.data" :key="task.id">
                <div class="flex items-center flex-1">
                    <input class="mr-2" type="checkbox" :checked="task.completed" @change="updateTask(task, $event)">
                    <span v-if="!task.isEditing" class="flex-1">{{ task.title }}</span>
                    <input
                        v-else
                        v-model="task.title"
                        @keyup.enter="saveTask(task)"
                        @blur="saveTask(task)"
                        class="w-full focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 border rounded" />
                </div>
                <div>
                    <button class="text-blue-500 hover:text-blue-700 mr-4" v-if="!task.isEditing" @click="editTask(task)">Редактировать</button>
                    <button class="text-red-500 hover:text-red-700" v-if="!task.isEditing" @click="deleteTask(task.id)">Удалить</button>
                </div>
            </li>
        </ul>

        <div v-if="tasks.last_page > 1" class="flex justify-center space-x-2 mt-4">
            <button @click="getTasks(tasks.prev_page_url)"
                    :disabled="!tasks.prev_page_url"
                    class="px-4 py-2 bg-blue-500 text-white font-semibold rounded-md hover:bg-blue-700 disabled:opacity-50 disabled:cursor-not-allowed">
                пред</button>
            <button @click="getTasks(tasks.next_page_url)"
                    :disabled="!tasks.next_page_url"
                    class="px-4 py-2 bg-blue-500 text-white font-semibold rounded-md hover:bg-blue-700 disabled:opacity-50 disabled:cursor-not-allowed">
                след</button>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            tasks: {
                data: [],
                next_page_url: null,
                prev_page_url: null,
                last_page: 1
            }
        };
    },
    mounted() {
        this.getTasks();
    },
    methods: {
        editTask(task) {
            task.isEditing = true;
        },

        async saveTask(task) {
            try {
                await axios.patch(`/api/tasks/${task.id}`, { title: task.title });
                task.isEditing = false;
            } catch (error) {
                console.error(`Ошибка при изменении названия задачи с ID ${task.id}:`, error);
            }
        },

        async getTasks(url = '/api/tasks') {
            try {
                const response = await axios.get(url);
                this.tasks = response.data;
            } catch (error) {
                console.error('Ошибка при загрузке задач:', error);
            }
        },

        async updateTask(task, event) {
            const newStatus = event.target.checked;
            task.completed = newStatus;

            try {
                await axios.patch(`/api/tasks/${task.id}`, { completed: newStatus });
            } catch (error) {
                console.error(`Ошибка при обновлении задачи с ID ${task.id}:`, error);
                event.target.checked = !event.target.checked; // Отменить изменения, если запрос не удался
            }
        },

        async deleteTask(taskId) {
            try {
                await axios.delete(`/api/tasks/${taskId}`);
                this.getTasks();
            } catch (error) {
                console.error('Ошибка при удалении задачи:', error);
            }
        },
    }
};
</script>
