package com.bangkit.nadira.util.baseclass

import android.view.View
import android.widget.Toast
import androidx.fragment.app.Fragment
import com.tapadoo.alerter.Alerter

open class BaseFragment : Fragment() {


    fun String.showLongToast(){
        Toast.makeText(requireContext(),this, Toast.LENGTH_LONG).show()
    }

    fun View.setVisible(){
        this.visibility = View.VISIBLE
    }

    fun View.setGone(){
        this.visibility = View.GONE
    }

    fun View.setInvisible(){
        this.visibility = View.INVISIBLE
    }

    fun showSweetAlert(title:String,desc:String,color : Int){
        Alerter.create(requireActivity())
            .setTitle(title)
            .setText(desc)
            .setBackgroundColorRes(color) // or setBackgroundColorInt(Color.CYAN)
            .show()
    }


}