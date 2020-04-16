class Post {

    /**
     * Fake find ORM function for the blog example
     */
    static find(id) {
        const numericId = parseInt(id);

        if (numericId === 1) {
            return {
                title: 'I am a blogpost',
                text: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut eget dui nisl. Maecenas a dolor dolor. Phasellus vulputate tellus ut magna iaculis vestibulum. In mollis laoreet felis, ac malesuada arcu. Aliquam bibendum turpis dui, ac molestie metus rutrum eu. Sed ut imperdiet ante, ac vulputate magna. Aenean in metus dui. Ut justo lectus, viverra non purus semper, dapibus accumsan augue. Pellentesque eu ultricies mi. Vestibulum efficitur ut urna eu semper. Pellentesque blandit, lacus eget pretium interdum, orci urna faucibus nisi, ac dapibus nisl urna sed enim. Donec cursus lorem et lorem gravida lobortis.'
            };
        }

        if (numericId === 3) {
            throw new Error('Database unreachable');
        }

        return null;
    }

}

module.exports = Post