<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property;
use App\Models\PropertyCategory;
use App\Models\PropertyAmenity;

class FrontController extends Controller
{
    public function index() 
    { 
        // Get 4 latest properties by category for Open Houses Listings
        $openHousesProperties = Property::with(['category', 'primaryImage'])
            ->active()
            ->notSold()
            ->latest()
            ->take(4)
            ->get();


        // Get 6 latest luxury properties for Today's Luxury Listings
        $luxuryProperties = Property::with(['category', 'primaryImage'])
            ->active()
            ->notSold()
            ->whereHas('category', function($query) {
                $query->where('name', 'LIKE', '%luxury%')
                      ->orWhere('name', 'LIKE', '%premium%')
                      ->orWhere('name', 'LIKE', '%villa%')
                      ->orWhere('name', 'LIKE', '%penthouse%');
            })
            ->latest()
            ->take(6)
            ->get();

        // If no luxury properties found, get the most expensive properties
        if ($luxuryProperties->isEmpty()) {
            $luxuryProperties = Property::with(['category', 'primaryImage'])
                ->active()
                ->notSold()
                ->orderBy('price', 'desc')
                ->latest()
                ->take(6)
                ->get();
        }

            // Get all property categories for search
    $categories = PropertyCategory::where('is_active', true)->get();

    // Top categories with counts + 3 preview listings each (Browse by Property Type)
    $categoriesWithCounts = PropertyCategory::where('is_active', true)
        ->withCount(['properties' => function($query) {
            $query->where('is_active', true)
                  ->where('is_deactivated', false)
                  ->where('is_sold', false);
        }])
        ->orderBy('properties_count', 'desc')
        ->take(6)
        ->get();

    foreach ($categoriesWithCounts as $category) {
        $category->setRelation(
            'previewProperties',
            Property::with('primaryImage')
                ->where('property_category_id', $category->id)
                ->active()
                ->notSold()
                ->latest()
                ->take(3)
                ->get()
        );
    }

    // Get all available amenities for search
    $amenities = PropertyAmenity::select('amenity_name')
        ->distinct()
        ->pluck('amenity_name')
        ->filter()
        ->values();

    return view('index', compact('openHousesProperties', 'luxuryProperties', 'categories', 'categoriesWithCounts', 'amenities')); 
    }
    public function contact() { return view('contact'); }
    public function dashboard() { return view('dashboard'); }
    public function faq() { return view('faq'); }
    public function pricing() { return view('pricing'); }
    public function about() { return view('about'); }
    public function career() { return view('career'); }
    public function review() { return view('review'); }
    public function serviceDetails() { return view('service-details'); }
    public function homeLoanProcess() { return view('home-loan-process'); }
    public function welcome() { return view('welcome'); }

    // Home Pages
    public function home02() { return view('home02'); }
    public function home03() { return view('home03'); }
    public function home04() { return view('home04'); }
    public function home05() { return view('home05'); }

    // Blog Pages
    public function blogList(Request $request) { 
        // Redirect to our new dynamic blog page
        return redirect()->route('blog.index');
    }
    public function blogGrid() { return view('blog-grid'); }
    public function blogDetail() { return view('blog-detail'); }
    public function blogSingle() { return view('blog-single'); }

    // Property Pages
    public function addProperty() { return view('add-property'); }
    public function propertyDetail($version) {
        return view("property-detail-v$version");
    }
    public function propertyFilterPopup() { return view('property-filter-popup'); }
    public function propertyGrid() { return view('property-grid'); }
    public function propertyGridLeftSidebar() { return view('property-grid-left-sidebar'); }
    public function propertyGridRightSidebar() { return view('property-grid-right-sidebar'); }
    public function propertyGridSearch() { return view('property-grid-to-p-search'); }
    public function propertyFullWidth() { return view('property-list-full-width'); }
    public function propertyHalfMap() { return view('property-half-map'); }

    // Agency Pages
    public function agencyList() { return view('agency-list'); }
    public function agencyDetails() { return view('agency-details'); }

    // User Account Pages
    public function myProfile() { return view('my-profile'); }
    public function myProperty() { return view('my-property'); }
    public function myPackage() { return view('my-package'); }
    public function mySaveSearch() { return view('my-save-search'); }
}
