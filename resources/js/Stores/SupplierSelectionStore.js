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
        toggleTagFilter(tagId) {
            const tagIndex = this.tagFilter.findIndex((tId) => tId === tagId)
            tagIndex > -1
                ? this.removeTagFilter(tagId)
                : this.tagFilter.push(tagId)
        },
        removeTagFilter(tagId) {
            this.tagFilter = this.tagFilter.filter(id => id !== tagId)
        }
    })
