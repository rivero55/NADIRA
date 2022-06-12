package com.bangkit.nadira.view.ui.send_report

import android.annotation.SuppressLint
import android.content.Context
import android.location.LocationListener
import android.location.LocationManager
import android.os.Bundle
import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import androidx.fragment.app.Fragment
import androidx.lifecycle.ViewModelProvider
import com.bangkit.nadira.R
import com.bangkit.nadira.viewmodel.InputReportViewModel
import com.google.android.gms.location.FusedLocationProviderClient
import com.google.android.gms.location.LocationServices
import com.google.android.gms.maps.CameraUpdateFactory
import com.google.android.gms.maps.GoogleMap
import com.google.android.gms.maps.OnMapReadyCallback
import com.google.android.gms.maps.SupportMapFragment
import com.google.android.gms.maps.model.BitmapDescriptorFactory
import com.google.android.gms.maps.model.LatLng
import com.google.android.gms.maps.model.Marker
import com.google.android.gms.maps.model.MarkerOptions
import com.google.android.libraries.places.api.Places
import java.util.*


class PickReportLocationFragment : Fragment() {
    var marker: Marker? = null

    private lateinit var myMap: GoogleMap

    lateinit var locationManager: LocationManager
    lateinit var locationListener: LocationListener
    lateinit var userLatLng: LatLng

    private lateinit var fusedLocationClient: FusedLocationProviderClient

    val viewModelInputReport by lazy { ViewModelProvider(requireActivity()).get(InputReportViewModel::class.java) }


    @SuppressLint("MissingPermission")
    private val callback = OnMapReadyCallback { googleMap ->

        myMap = googleMap
        /**
         * Manipulates the map once available.
         * This callback is triggered when the map is ready to be used.
         * This is where we can add markers or lines, add listeners or move the camera.
         * In this case, we just add a marker near Sydney, Australia.
         * If Google Play services is not installed on the device, the user will be prompted to
         * install it inside the SupportMapFragment. This method will only be triggered once the
         * user has installed Google Play services and returned to the app.
         */

        userLatLng = LatLng(0.0, 0.0)

        myMap.isMyLocationEnabled = true
        myMap.uiSettings.isMyLocationButtonEnabled = true
        getLastKnownLocation()

        myMap.setOnMapClickListener { latlng -> // TODO Auto-generated method stub
            if (marker != null) {
                marker?.remove()
            }
            userLatLng = latlng
            marker = myMap.addMarker(
                MarkerOptions()
                    .position(latlng)
                    .icon(
                        BitmapDescriptorFactory
                            .defaultMarker(BitmapDescriptorFactory.HUE_RED)
                    )
            )
            println(latlng)

            viewModelInputReport.vmLat.postValue(latlng.latitude)
            viewModelInputReport.vmLong.postValue(latlng.longitude)
        }
    }

    override fun onCreateView(
        inflater: LayoutInflater,
        container: ViewGroup?,
        savedInstanceState: Bundle?
    ): View? {
        if (!Places.isInitialized()) {
            Places.initialize(requireContext(), getString(R.string.google_maps_key), Locale.US);
        }
        return inflater.inflate(R.layout.fragment_pick_report_location, container, false)
    }

    override fun onViewCreated(view: View, savedInstanceState: Bundle?) {
        super.onViewCreated(view, savedInstanceState)
        val mapFragment = childFragmentManager.findFragmentById(R.id.map) as SupportMapFragment?
        mapFragment?.getMapAsync(callback)


        fusedLocationClient = LocationServices.getFusedLocationProviderClient(requireActivity())
        locationManager =
            requireActivity().getSystemService(Context.LOCATION_SERVICE) as LocationManager

//        val autocompleteFragment =
//            requireActivity().supportFragmentManager.findFragmentById(R.id.autocomplete_fragment)
//                    as AutocompleteSupportFragment
//        // Specify the types of place data to return.
//        autocompleteFragment.setPlaceFields(listOf(Place.Field.ID, Place.Field.NAME))

        // Set up a PlaceSelectionListener to handle the response.
//        autocompleteFragment.setOnPlaceSelectedListener(object : PlaceSelectionListener {
//            override fun onPlaceSelected(place: Place) {
//                // TODO: Get info about the selected place.
//                Log.i(TAG, "Place: ${place.name}, ${place.id}")
//            }
//
//            override fun onError(status: Status) {
//                // TODO: Handle the error.
//                Log.i(TAG, "An error occurred: $status")
//            }
//        })


    }

    @SuppressLint("MissingPermission")
    //Permission Already Checked at Parent Activity
    private fun getLastKnownLocation() {

        fusedLocationClient.lastLocation
            .addOnSuccessListener { location ->
                if (location != null) {
                    myMap.clear()
                    userLatLng = LatLng(location.latitude, location.longitude)
                    val myLocation = userLatLng
                    marker = myMap.addMarker(
                        MarkerOptions()
                            .position(myLocation)
                            .icon(
                                BitmapDescriptorFactory
                                    .defaultMarker(BitmapDescriptorFactory.HUE_RED)
                            )
                    )
                    myMap.moveCamera(CameraUpdateFactory.newLatLng(myLocation))
                    myMap.animateCamera(CameraUpdateFactory.zoomTo(17.0f))
                    viewModelInputReport.vmLat.postValue(myLocation.latitude)
                    viewModelInputReport.vmLong.postValue(myLocation.longitude)
                }
            }


    }


}