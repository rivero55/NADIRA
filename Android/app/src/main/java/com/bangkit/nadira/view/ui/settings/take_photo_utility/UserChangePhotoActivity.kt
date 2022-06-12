package com.bangkit.nadira.view.ui.settings.take_photo_utility

import android.app.Activity
import android.content.Intent
import android.net.Uri
import android.os.Bundle
import androidx.lifecycle.Observer
import androidx.lifecycle.ViewModelProvider
import com.bangkit.nadira.R
import com.bangkit.nadira.databinding.ActivityUserChangePhotoBinding
import com.bangkit.nadira.util.Resource
import com.bangkit.nadira.util.SharedPreference.Preference
import com.bangkit.nadira.util.SharedPreference.const
import com.bangkit.nadira.util.baseclass.BaseActivity
import com.bangkit.nadira.viewmodel.ProfileViewModel
import com.squareup.picasso.Picasso
import com.theartofdev.edmodo.cropper.CropImage
import com.theartofdev.edmodo.cropper.CropImageView
import timber.log.Timber
import java.io.File

class UserChangePhotoActivity : BaseActivity() {

    val profileViewModel by lazy { ViewModelProvider(this).get(ProfileViewModel::class.java) }

    val vbind by lazy { ActivityUserChangePhotoBinding.inflate(layoutInflater) }

    lateinit var imageFile : File

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(vbind.root)

        Picasso
            .get()
            .load(Preference(this).getPrefString(const.USER_PHOTO))
            .placeholder(R.drawable.ic_loading_gif)
            .error(R.drawable.ic_empty_profile)
            .into(vbind.ivProfilePict)

        vbind.btnSaveChanges.setOnClickListener {
            profileViewModel.updateImage(Preference(this).getPrefString(const.USER_ID).toString(),imageFile)
        }

        vbind.btnChangePhoto.setOnClickListener {
            takePicture()
        }

        setUpObserver()
    }

    private fun setUpObserver() {
        profileViewModel.updatePhoto.observe(this, Observer {
            when (it) {
                is Resource.Loading -> {
                    vbind.includeLoading.loadingRoot.setVisible()
                    "Loading".showLongToast()
                }
                is Resource.Error -> {
                    vbind.includeLoading.loadingRoot.setGone()
                    showSweetAlert("Gagal","Gagal Mengupdate Foto Profile",R.color.xdRed)
                    "Error".showLongToast()
                }
                is Resource.Success -> {
                    vbind.includeLoading.loadingRoot.setGone()
                    showSweetAlert("Berhasil","Berhasil Mengupdate Foto Profile",R.color.xdGreen)
                    Timber.d("register: success")
                }
                else -> {}
            }
        })
    }

    private fun takePicture() {
        CropImage.activity()
            .setGuidelines(CropImageView.Guidelines.ON)
            .start(this);
    }

    override fun onActivityResult(requestCode: Int, resultCode: Int, data: Intent?) {
        super.onActivityResult(requestCode, resultCode, data)
        if (requestCode == CropImage.CROP_IMAGE_ACTIVITY_REQUEST_CODE) {
            val result = CropImage.getActivityResult(data)
            if (resultCode == Activity.RESULT_OK) {
                val resultUri: Uri = result.uri
                Timber.d("Image Berhasil Diambil")
                imageFile = File(resultUri.path.toString())
                vbind.ivProfilePict.setImageURI(resultUri)
            }
        }
    }



}