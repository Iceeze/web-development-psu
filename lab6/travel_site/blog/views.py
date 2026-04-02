from django.shortcuts import render, get_object_or_404
from .models import City, Post, Page, Tour


def home(request):
    page = get_object_or_404(Page, slug="home")
    return render(request, "blog/home.html", {"page": page})


def about_page(request):
    page = get_object_or_404(Page, slug="about")
    return render(request, "blog/about.html", {"page": page})


def posts_list(request):
    posts = Post.objects.all().order_by("-created_at")
    return render(request, "blog/posts_list.html", {"posts": posts})


def post_detail(request, post_id):
    post = get_object_or_404(Post, id=post_id)
    return render(request, "blog/post_detail.html", {"post": post})


def cities_list(request):
    cities = City.objects.all()
    return render(request, "blog/cities_list.html", {"cities": cities})


def city_detail(request, slug):
    city = get_object_or_404(City, slug=slug)
    attractions = city.attractions.all()
    return render(
        request,
        "blog/city_detail.html",
        {
            "city": city,
            "attractions": attractions,
        },
    )


def tours_list(request):
    tours = Tour.objects.all()
    return render(request, 'blog/tours.html', {'tours': tours})
