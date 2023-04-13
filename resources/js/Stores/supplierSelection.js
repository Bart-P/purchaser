import { reactive } from 'vue';

export default reactive(
    {
        searchTerm: '',
        categoryFilter: [],
        tagFilter: [],
        addSearchTerm(searchTerm) {
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
            this.categoryFilter = [catId]
            this.tagFilter = []
        },
        removeCategoryFilter(catId) {
            this.categoryFilter = this.categoryFilter.filter(id => id !== catId)
            this.tagFilter = []
        },
        addTagFilter(tagId) {
            this.tagFilter.push(tagId)
        },
        removeTagFilter(tagId) {
            this.tagFilter = this.tagFilter.filter(id => id !== tagId)
        }
    })
