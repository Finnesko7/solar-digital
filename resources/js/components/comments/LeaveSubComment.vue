<template>
    <div>
    <textarea

        v-model="text"
        class="form-control"
        rows="1"
        v-on:blur="addComment"
    ></textarea>
    </div>
</template>

<script>
export default {
    name: "LeaveSubComment",
    props: {
        cbCloseAddComment: Function,
        cbGetSubComments: Function,
        mainId: Number,
        parentId: Number
    },
    data () {
        return {
            text: ''
        }
    },
    methods: {
        addComment: function () {
            this.leaveComment = false;
            console.log("main id>>>", this.mainId)

            if (this.text) {
                fetch(`/api/comment`, {
                    method: 'POST',
                    headers: {
                        'Content-type': 'application/json; charset=UTF-8'
                    },
                    body: JSON.stringify({
                        message: this.text,
                        main_id: this.mainId,
                        post_id: this.$route.params.id,
                        parent_id: this.parentId
                    })
                }).then(response => response.json())
                    .then(data => {
                        if (data.id) {
                            this.text = '';
                            this.cbGetSubComments();
                        }
                    })
            }

            this.cbCloseAddComment()
        },
    }
}
</script>

<style scoped>

</style>
