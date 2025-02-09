<template>
    <div class="container mx-auto my-10">
        <h1 class="text-center text-3xl font-semibold mb-4">Список задач</h1>
        <div class="md:w-1/2 mx-auto">
            <div class="bg-white shadow-md rounded-lg p-6">
                <AddTask @taskAdded="fetchTasks" />
                <TaskList ref="taskList" />
            </div>
        </div>
    </div>
</template>

<script>
import TaskList from './components/TaskList.vue';
import AddTask from './components/AddTask.vue';

export default {
    components: {
        TaskList,
        AddTask
    },
    methods: {
        fetchTasks() {
            this.$refs.taskList.getTasks();
        }
    }
};
</script>
