<template>
    <div class="">
        <select v-model="category_id" class="form-control m-md-2">
            <option value="">-- Choose Category</option>
            <option v-for="category in categories" :value="category.id">
                {{category.name}}
            </option>
        </select>
        <table class="table table-border">
            <thead>
            <tr>
                <th>
                    <a href="#" @click.prevent="change_sort('title')">Title</a>
                    <span v-if="this.sort_field === 'title' && this.sort_direction ==='asc'">&uarr;</span>
                    <span v-if="this.sort_field === 'title' && this.sort_direction ==='desc'">&darr;</span>
                </th>
                <th>
                    <a href="#" @click.prevent="change_sort('text')">Post text</a>
                    <span v-if="this.sort_field === 'text' && this.sort_direction ==='asc'">&uarr;</span>
                    <span v-if="this.sort_field === 'text' && this.sort_direction ==='desc'">&darr;</span>
                </th>
                <th>
                    <a href="#" @click.prevent="change_sort('created_at')">Create date</a>
                    <span v-if="this.sort_field === 'created_at' && this.sort_direction ==='asc'">&uarr;</span>
                    <span v-if="this.sort_field === 'created_at' && this.sort_direction ==='desc'">&darr;</span>
                </th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="post in posts.data">
                <td>{{post.title}}</td>
                <td>{{post.text}}</td>
                <td>{{post.created_at}}</td>
                <td>
                    <router-link class="btn btn-info btn-sm" :to="{ name: 'posts.edit', params: { id: post.id }}">Edit</router-link>
                    <button @click="delete_post(post.id)" class="btn btn-danger btn-sm">Delete</button>
                </td>
            </tr>
            </tbody>
        </table>
        <pagination :data="posts" @pagination-change-page="getResults"></pagination>
    </div>

</template>

<script>
    export default {
        data() {
            return {
                posts: {},
                categories: {},
                category_id: '',
                sort_field: 'created_at',
                sort_direction: 'desc'
            }
        },
        mounted(){
            this.getResults();
            axios.get('/api/categories')
                .then(response => {
                    this.categories = response.data.data;
                });
        },
        watch: {
          category_id(value) {this.getResults();}
        },
        methods: {
            delete_post(id){
                this.$swal({
                    title: "Are ou sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete it!',
                }).then((result) => {
                    if(result.value) {
                        axios.delete('/api/posts/' + id).then(response => {
                            this.$swal('Post deleted successfully');
                            this.getResults();
                        }).catch(error => {
                            this.$swal({
                                icon: 'error',
                                title: 'Error happened'
                            });
                        });
                    }
                });
              },
            change_sort(field){
                if(this.sort_field === field) {
                    this.sort_direction = this.sort_direction === 'asc' ? 'desc' : 'asc' ;
                } else {
                    this.sort_field = field;
                    this.sort_direction = 'asc';
                }
                this.getResults();
            },
            // Our method to GET results from a Laravel endpoint
            getResults(page = 1) {
                axios.get('/api/posts?page=' + page
                    +'&category_id=' + this.category_id
                    +'&sort_field=' + this.sort_field
                    +'&sort_direction=' + this.sort_direction)
                    .then(response => {
                        this.posts = response.data;
                    });
            }
        }
    }
</script>
