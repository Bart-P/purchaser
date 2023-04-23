import { reactive } from 'vue';

export default reactive(
    {
        searchTerm: '',
        categoryFilter: [],
        tagFilter: [],
        sort: {
            column: '',
            direction: '',
        },
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
            this.sort = {
                column: '',
                direction: ''
            }
        },
        toggleCategoryFilter(catId) {
            this.tagFilter = []
            const CatIndex = this.categoryFilter.findIndex((categoryId) => categoryId === catId)
            CatIndex > -1
                ? this.categoryFilter = []
                : this.categoryFilter = [catId]
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
        },
        sortBy(column) {
            if (this.sort.column != column) {
                this.sort.direction = ''
            }
            this.sort.column = column
            if (this.sort.direction === 'asc') {
                this.sort.direction = 'desc'
            } else if (this.sort.direction === 'desc') {
                this.sort.direction = ''
            } else if (this.sort.direction === '') {
                this.sort.direction = 'asc'
            }

            return this.sort.direction
        },
        resetSort() {
            this.sort = {
                column: '',
                direction: ''
            }
        }
    })