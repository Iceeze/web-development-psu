from django.urls import path
from . import views


urlpatterns = [
    path("", views.home, name="home"),
    path("post/<int:post_id>/", views.post_detail, name="post_detail"),
    path("cities/", views.cities_list, name="cities_list"),
    path("cities/<slug:slug>/", views.city_detail, name="city_detail"),
    path("about/", views.about_page, name="about"),
]
