const hi = {
    data: ['Job 1', 'job 2', 'job 3'],
    open: false,
    focusedOptionIndex: null,
    options: {},
    emptyOptionsMessage: 'No results match your search.',
    name: '',
    placeholder: 'Select an option',
    search: '',
    value: '',

    toggleListboxVisibility() {
        if (open) {
            open = false
            focusedOptionIndex = null

            search = ''
        }

        this.focusedOptionIndex = Object.keys(this.options).indexOf(this.value)

        if (this.focusedOptionIndex < 0) this.focusedOptionIndex = 0

        this.open = true

        this.$nextTick(() => {
            this.$refs.search.focus()

            this.$refs.listbox.children[this.focusedOptionIndex].scrollIntoView({
                block: 'nearest'
            })
        })
    },

    closeListbox() {
        open = false

        focusedOptionIndex = null

        search = ''
    },

}