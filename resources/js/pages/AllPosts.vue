<template>
       <div class="container post-list">
           <Card v-for="post in posts" :key="post.id"></Card>
       </div>
</template>

<script>
import Card from "../components/post/Card";

export default {
    name: "AllPosts",
    components: {Card},
    data() {
        return {
            posts: []
        }
    },
    methods: {
        getPosts: function () {
            fetch('http://jsonplaceholder.typicode.com/posts')
                .then(response => {
                    return response.json()
                })
                .then(data => {
                    data.length = 10;
                    this.posts = data
                    console.log("posts", data)
                })
        }
    },
    mounted() {
        this.getPosts()
    }
}
</script>

<style scoped>

</style>
