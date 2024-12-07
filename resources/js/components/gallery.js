export function getImageUrl(image) {
    // We'll need to pass the storage URL from PHP to JS
    return window.storageUrl + image;
}

export function productGallery(images, initialImage) {
    return {
        images: images,
        selectedImage: initialImage,
        isOpen: false,
        currentIndex: 0,
        get currentImage() {
            return this.images[this.currentIndex];
        },
        openGallery() {
            if (this.selectedImage) {
                this.currentIndex = this.images.indexOf(this.selectedImage);
            }
            this.isOpen = true;
        },
        closeGallery() {
            this.isOpen = false;
        },
        nextImage() {
            this.currentIndex = (this.currentIndex + 1) % this.images.length;
            this.selectedImage = this.images[this.currentIndex];
        },
        prevImage() {
            this.currentIndex = (this.currentIndex - 1 + this.images.length) % this.images.length;
            this.selectedImage = this.images[this.currentIndex];
        }
    };
}
