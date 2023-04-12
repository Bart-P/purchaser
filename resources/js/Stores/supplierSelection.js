import { reactive } from 'vue';

export default reactive(
    {
        searchTerm: '',
        categoryFilter: [],
        tagFilter: [],
        add(searchTerm) {
            this.searchTerm = searchTerm
        },
        removeSearchTerm() {
            this.searchTerm = ''
        },
        resetFields() {
            this.searchTerm = ''
            this.categoryFilter = []
            this.tagFilter = []
        },
        addCategoryFilter(catId) {
            this.categoryFilter.push(catId)
        },
        removeCategoryFilter(catId) {
            this.categoryFilter = this.tagFilter.filter(id => id !== catId)
        },
        addTagFilter(tagId) {
            this.tagFilter.push(tagId)
        },
        removeTagFilter(tagId) {
            this.tagFilter = this.tagFilter.filter(id => id !== tagId)
        }
    })
