<template>
    <div>
        <h2>Список задач</h2>
        <ul>
            <li v-for="task in tasks.data" :key="task.id">
                <input type="checkbox" :checked="task.completed" @change="updateTask(task, $event)">
                <span v-if="!task.isEditing">{{ task.title }}</span>
                <input v-else v-model="task.title" @keyup.enter="saveTask(task)" @blur="saveTask(task)" />
                <button v-if="!task.isEditing" @click="editTask(task)">Редактировать</button>
                <button @click="deleteTask(task.id)">Удалить</button>
            </li>
        </ul>

        <div v-if="tasks.last_page > 1">
            <button @click="getTasks(tasks.prev_page_url)" :disabled="!tasks.prev_page_url">пред</button>
            <button @click="getTasks(tasks.next_page_url)" :disabled="!tasks.next_page_url">след</button>
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

                let newTasks = [];
                let oldTasks = response.data.data;
                for (let i = 0; i < oldTasks.length; i++) {
                    let task = oldTasks[i];

                    newTasks.push({
                        id: task.id,
                        title: task.title,
                        completed: task.completed ? true : false
                    });
                }

                response.data.data = newTasks;
                this.tasks = response.data;
            } catch (error) {
                console.error('Ошибка при загрузке задач:', error);
            }
        },

        async updateTask(task, event) {
            try {
                const newStatus = event.target.checked;

                await axios.patch(`/api/tasks/${task.id}`, {
                    completed: newStatus
                });
            } catch (error) {
                console.error(`Ошибка при обновлении задачи с ID ${task.id}:`, error);
                event.target.checked = !event.target.checked;
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
