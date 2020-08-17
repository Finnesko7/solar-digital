<template>
    <div class="media mb-4">
        <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
        <div class="media-body">
            <h5 class="mt-0">Author 2</h5>

            <div class="comment-buttons">
                <button class="btn btn-light btn-sm" v-on:click="">
                    <i class="fas fa-pencil-alt"></i>
                </button>
                <button class="btn badge-danger btn-sm" v-on:click="">
                    <i class="fas fa-trash"></i>
                </button>
            </div>
            Some text ...
        </div>
    </div>
</template>

<script>
    export default {
        name: "SubComment",
        props: {
            subComments: Array
        }
    }
</script>

<style scoped>

</style>
