$(document).ready(function () {
    $(document).on('click', '#load_more_btn', () => {
        data = $(`#items_page a`).map((e, obj) => {
            link = obj.href;
            data = link.split('/')
            id = data[data.length - 1]
            return id;
        });
        id = data[data.length - 1]
        $.ajax({
            url: `/ajax_load_more`,
            type: 'POST',
            data: {
                'data': id
            },
            success: function (data) {
                posts = JSON.parse(data);
                page_data = $(`#items_page`);
                for (const i in posts) {
                    page_data.append(`
                    <a href="/post/${posts[i].id}" class="card-link">
                        <div class="main-block__item item-main">
                            <div class="item-main__icon">
                                <img src="${posts[i].image_url}" alt="Content"/>
                            </div>
                            <div class="item-main__block-inscription block-inscription">
                                <div class="block-inscription__name">
                                    ${posts[i].title}
                                </div>
                                <div class="block-inscription__date">${posts[i].date}</div>
                            </div>
                            <div class="item-main__block-user block-user">
                                <div class="block-user__icon">
                                    <img src="${posts[i].author_image}" alt="Content"/>
                                </div>
                                <div class="block-user__nickname">${posts[i].author_name}</div>
                            </div>
                        </div>
                    </a>
                `)
                }
            },
            error: function (data) {
                console.log(data);
            }
        });
    });
});