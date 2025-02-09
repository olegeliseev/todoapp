<template>
    <div>
        <h1>Todo List</h1>
        <AddTask @taskAdded="fetchTasks" />
        <TaskList ref="taskList" />
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
