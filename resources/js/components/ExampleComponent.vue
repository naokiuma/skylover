<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Example Component</div>


                    <div class="card-body">
                        I'm an example componentです.
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<template>
    <div class="form-group container-fruid ">
    <label for="category_name" class="font-s">カテゴリで検索</label><br>
      <select class="font-s" v-model="selected"  v-on:change="testFunc">
        <option value="1" selected>明るい空</option>
        <option value="2">夕の空</option>
        <option value="3">雲</option>
        <option value="4">光景</option>
        <option value="5">人工の光景</option>
      </select>
      <span>Selected: {{ selected }}</span>
    </div>
</template>

<template>

</template>

<script>
    export default {
        props:['posts'],
        data:function(){
          return{
            category_id:[],
            selected: ''
            }
        },
        methods:{
        testFunc:function(){
        console.log("テストです"),
        console.log(this.selected)
          }
        },
        mounted() {
            console.log('Component mounted.'),
            axios.get('/posts/gallery').then(response => this.posts),
            console.log(this.posts)
        }
    }
</script>
