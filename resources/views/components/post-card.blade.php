<div class="col-md-4 mb-4">
    <div class="card w-[500px] overflow-hidden shadow-sm border-slate-200 scrollbar-hide">
        <!-- Header Card -->
        <div class="card-header flex items-center justify-between bg-black text-white">
            <div class="flex items-center">
                @if($post->user)
                    <!-- Code untuk menampilkan informasi pengguna -->
                    <img src="{{ Storage::url('profile_photos/' . $post->user->profile_photo_url) }}" class="rounded-full h-10 w-10 object-cover mr-2" alt="Profile Image">
                    <div>
                        <h5 class="m-0">{{ $post->user->name }}</h5>
                        <p class="m-0 text-sm text-gray-400">{{ $post->created_at->diffForHumans() }}</p>
                    </div>
                @endif

            </div>
            <a href="javascript:void(0);" class="bookmark" data-post-id="{{$post->id}}">
                <svg class="default-bookmark" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="white">
                    <path d="M200-120v-640q0-33 23.5-56.5T280-840h400q33 0 56.5 23.5T760-760v640L480-240 200-120Zm80-122 200-86 200 86v-518H280v518Zm0-518h400-400Z"/>
                </svg>
                <svg class="toggled-bookmark tutup" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="red">
                    <path d="M200-120v-640q0-33 23.5-56.5T280-840h400q33 0 56.5 23.5T760-760v640L480-240 200-120Z"/>
                </svg>
            </a>
        </div>
        
        <!-- Image Post -->
        @if($post->image_path)
            <img src="{{ Storage::url($post->image_path) }}" class="card-img-top object-cover h-[300px]" alt="Post Image">
        @endif

        <!-- Card Body -->
        <div class="card-body bg-black text-white">
            <p class="card-text mb-2">{{ $post->caption }}</p>
            <div class="flex gap-3">
                <a href="javascript:void(0);" class="like" data-post-id="{{ $post->id }}">
                    <svg class="default-like" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="white">
                        <path d="m480-131-54-48.5q-99.27-89.57-164.13-154.54Q197-399 158.72-450.4q-38.29-51.4-53.5-94.48Q90-587.96 90-633q0-91.01 61-152 60.99-61 152-61 51.29 0 97.64 22Q447-802 480-761q34.5-41 80-63t97-22q91.01 0 152 61 61 60.99 61 152 0 45.04-15.22 88.12-15.21 43.08-53.5 94.48Q763-399 698.13-334.04 633.27-269.07 534-179.5L480-131Zm0-101q94-85 155-145.5T731.5-483q35.5-45 49.5-80.18 14-35.18 14-69.86 0-67-43-110t-110-43q-34 0-64 12.5T517-768l-37 39-37-39q-24-27-54-39.5T325-798q-67 0-110 43t-43 110q0 34.68 14 69.86Q200-501 235.5-456T390-276.5q61 60.5 155 145.5ZM480-483Z"/>
                    </svg>
                    <svg class="toggled-like tutup" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="red">
                        <path d="m480-120-58-52q-101-91-167-157T150-447.5Q111-500 95.5-544T80-634q0-94 63-157t157-63q52 0 99 22t81 62q34-40 81-62t99-22q94 0 157 63t63 157q0 46-15.5 90T810-447.5Q771-395 705-329T538-172l-58 52Z"/>
                    </svg>
                </a>
                <span>{{ $post->likes->count() }} likes</span>
                <a href="">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="white">
                        <path d="M90-95v-701q0-30.94 22.03-52.97Q134.06-871 165-871h630q30.94 0 52.97 22.03Q870-826.94 870-796v472q0 30.94-22.03 52.97Q825.94-249 795-249H244L90-95Zm156-310h311v-75H246v75Zm0-118h468v-75H246v75Zm0-118h468v-75H246v75Z"/>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // Bookmark
    document.querySelectorAll('.bookmark').forEach(button => {
        button.addEventListener('click', function () {
            const postId = this.getAttribute('data-post-id');
            const defaultBookmark = this.querySelector('.default-bookmark');
            const toggledBookmark = this.querySelector('.toggled-bookmark');
            const isBookmarked = !defaultBookmark.classList.contains('hidden');

            fetch(`/save-post/${postId}`, {
                method: isBookmarked ? 'DELETE' : 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    defaultBookmark.classList.toggle('hidden', isBookmarked);
                    toggledBookmark.classList.toggle('hidden', !isBookmarked);
                } else {
                    console.error('Bookmark error:', data.message);
                    console(data.message);
                }
            })
            .catch(error => console.error('Error:', error));
        });
    });

    // Like
    document.querySelectorAll('.like').forEach(button => {
        button.addEventListener('click', function () {
            const postId = this.getAttribute('data-post-id');
            const defaultLike = this.querySelector('.default-like');
            const toggledLike = this.querySelector('.toggled-like');
            const isLiked = !defaultLike.classList.contains('hidden');
            const method = isLiked ? 'DELETE' : 'POST';

            fetch(`/like/${postId}`, {
                method: method,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    defaultLike.classList.toggle('hidden', isLiked);
                    toggledLike.classList.toggle('hidden', !isLiked);
                } else {
                    console(data.message);
                }
            })
            .catch(error => console.error('Error:', error));
        });
    });
});




</script>