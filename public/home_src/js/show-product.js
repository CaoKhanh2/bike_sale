$('#carouselExampleIndicators').on('slid.bs.carousel', function(e) {
    let activeIndex = $(this).find('.carousel-item.active').index();
    var imageList = document.querySelectorAll('.image-list img');

    console.log(activeIndex);

    // Xóa lớp 'border-primary' khỏi tất cả các ảnh
    imageList.forEach(function(img) {
        img.classList.remove('border-primary');
    });

    // Thêm lớp 'border-primary' đến hình ảnh tương ứng trong danh sách
    var activeImage = imageList[activeIndex];
    activeImage.classList.add('border-primary');
});





