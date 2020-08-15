<template>
    <div class="card m-2" style="width: 18rem;">
        <img v-bind:src="image" class="card-img-top" alt="">
        <div class="card-body">
            <h5 class="card-title">{{title}}</h5>
            <blockquote class="mb-0">
                <p class="card-text mb-5">{{description}}</p>
                <footer class="p-2">
                    <button class="btn btn-light" v-on:click="showModal">
                        <i class="fas fa-pencil-alt"></i>
                    </button>
                    <button class="btn badge-danger">
                        <i class="fas fa-trash"></i>
                    </button>
                    <a v-bind:href="`/post/${id}`" class="btn btn-primary">See post</a>
                </footer>
            </blockquote>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'Card',
        props: {
            id: Number,
            title: String,
            description: String,
            image: String,
            callbackEditPost: Function
        },
        methods: {
            showModal: function () {
                this.callbackEditPost(this.id)
            }
        }
    }
</script>

<style scoped>

</style>
